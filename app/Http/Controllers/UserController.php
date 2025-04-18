<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Pesquisa por nome ou email
        if ($search = $request->input('search')) {
            $query->where(fn($q) =>
                $q->where('name','like',"%{$search}%")
                  ->orWhere('email','like',"%{$search}%")
            );
        }

        // Filtro por role
        if ($role = $request->input('role')) {
            $query->where('role', $role);
        }

        $users = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('users.index', compact('users','search','role'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone'    => 'nullable|string|max:20',
            'role'     => ['required', Rule::in(['user','admin'])],
            'birthday' => 'nullable|date',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()
            ->route('users.index')
            ->with('success','Utilizador criado com sucesso.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ["required","email",Rule::unique('users','email')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'phone'    => 'nullable|string|max:20',
            'role'     => ['required', Rule::in(['user','admin'])],
            'birthday' => 'nullable|date',
        ]);

        // Se veio senha, faz hash; senão remove do array
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('success','Utilizador atualizado com sucesso.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success','Utilizador eliminado.');
    }
}
