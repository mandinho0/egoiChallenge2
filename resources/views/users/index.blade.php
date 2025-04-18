@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-between my-3">
    <h2>Utilizadores</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Novo Utilizador</a>
  </div>

  <form method="GET" class="form-inline mb-3">
    <input name="search"    value="{{ $search }}" placeholder="Pesquisar..." class="form-control mr-2">
    <select name="role" class="form-control mr-2">
      <option value="">Todas as roles</option>
      <option value="user"  {{ $role=='user'?'selected':'' }}>User</option>
      <option value="admin" {{ $role=='admin'?'selected':'' }}>Admin</option>
    </select>
    <button class="btn btn-outline-secondary">Filtrar</button>
  </form>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nome</th><th>Email</th><th>Telefone</th><th>Role</th><th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $u)
        <tr>
          <td>{{ $u->name }}</td>
          <td>{{ $u->email }}</td>
          <td>{{ $u->phone }}</td>
          <td>{{ ucfirst($u->role) }}</td>
          <td>
            <a href="{{ route('users.show',$u) }}"  class="btn btn-sm btn-info">Ver</a>
            <a href="{{ route('users.edit',$u) }}"  class="btn btn-sm btn-warning">Editar</a>
            <form action="{{ route('users.destroy',$u) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Eliminar este utilizador?')">Eliminar</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $users->links() }}
@endsection
