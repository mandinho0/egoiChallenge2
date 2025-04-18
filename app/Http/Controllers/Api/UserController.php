<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // GET /api/users
    public function index()
    {
        // Retorna lista completa (ou você pode paginar)
        return response()->json(User::all());
    }

    // GET /api/users/{user}
    public function show(User $user)
    {
        return response()->json($user);
    }

    // POST /api/users
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'phone'    => 'nullable|string|max:20',
            'role'     => ['required', Rule::in(['user','admin'])],
            'birthday' => 'nullable|date',
        ]);

        // Hash da senha
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        // 201 Created
        return response()->json($user, 201);
    }

    // PUT /api/users/{user}
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'sometimes|required|string|max:255',
            'email'    => ['sometimes','required','email', Rule::unique('users','email')->ignore($user->id)],
            'password' => 'nullable|string|min:8',
            'phone'    => 'nullable|string|max:20',
            'role'     => ['sometimes','required', Rule::in(['user','admin'])],
            'birthday' => 'nullable|date',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json($user);
    }

    // DELETE /api/users/{user}
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
}
