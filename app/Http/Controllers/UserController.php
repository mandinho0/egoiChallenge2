<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role   = $request->input('role');

        Log::info('Listagem de utilizadores requisitada', [
            'pesquisa' => $search,
            'filtro'   => $role,
        ]);

        $query = User::query();

        if ($search) {
            $query->where(fn($q) =>
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
            );
        }

        if ($role) {
            $query->where('role', $role);
        }

        $users = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('users.index', compact('users', 'search', 'role'));
    }

    public function create()
    {
        Log::info('Formulário de criação de utilizador exibido');
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

        $user = User::create($data);

        Log::info('Utilizador criado com sucesso', [
            'id'    => $user->id,
            'email' => $user->email,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilizador criado com sucesso.');
    }

    public function show(User $user)
    {
        Log::info('Visualização de utilizador', [
            'id'    => $user->id,
            'email' => $user->email,
        ]);

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        Log::info('Formulário de edição de utilizador exibido', [
            'id'    => $user->id,
            'email' => $user->email,
        ]);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required','email',Rule::unique('users','email')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'phone'    => 'nullable|string|max:20',
            'role'     => ['required', Rule::in(['user','admin'])],
            'birthday' => 'nullable|date',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        Log::info('Utilizador atualizado com sucesso', [
            'id'       => $user->id,
            'alterado'=> array_keys($data),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilizador atualizado com sucesso.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        Log::warning('Utilizador eliminado', [
            'id'    => $user->id,
            'email' => $user->email,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilizador eliminado.');
    }

    public function export(): StreamedResponse
    {
        $fileName = 'users-' . now()->format('Ymd_His') . '.csv';

        Log::info('Exportação CSV iniciada', [
            'ficheiro' => $fileName,
        ]);

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $columns = ['ID','Nome','Email','Telefone','Role','Data de Nascimento','Criado em'];

        $callback = function() use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            User::orderBy('id')->chunk(100, function($users) use ($handle) {
                foreach ($users as $u) {
                    fputcsv($handle, [
                        $u->id,
                        $u->name,
                        $u->email,
                        $u->phone,
                        ucfirst($u->role),
                        $u->birthday?->toDateString(),
                        $u->created_at->toDateTimeString(),
                    ]);
                }
            });

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
