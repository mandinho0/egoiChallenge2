@extends('layouts.app')

@section('content')
  <div class="justify-content-between mt-3 mb-4 new-user">
    <h2>Utilizadores</h2>
    <a href="{{ route('users.export') }}"
       class="btn btn-success me-2 ">
      <i class="bi bi-file-earmark-spreadsheet"></i> Exportar CSV
    </a>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Novo Utilizador</a>
  </div>

  <form method="GET" class="mb-3 d-flex align-items-center gap-2">
    <input
      name="search"
      value="{{ $search }}"
      placeholder="Pesquisar..."
      class="filter-field form-control" />
  
    <select
      name="role"
      class="filter-field form-select">
      <option value="">Todas as roles</option>
      <option value="user"  {{ $role=='user'?'selected':'' }}>User</option>
      <option value="admin" {{ $role=='admin'?'selected':'' }}>Admin</option>
    </select>
  
    <button type="submit" class="filter-field btn btn-outline-secondary">
      Filtrar
    </button>
  </form>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Role</th>
        <th class="text-end">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $u)
        <tr>
          <td>{{ $u->name }}</td>
          <td>{{ $u->email }}</td>
          <td>{{ $u->phone }}</td>
          <td>{{ ucfirst($u->role) }}</td>
          <td class="text-end align-middle">
            <a href="{{ route('users.show', $u) }}"
               class="text-info me-2"
               title="Ver">
              <i class="bi bi-eye"></i>
            </a>
            <a href="{{ route('users.edit', $u) }}"
               class="text-warning me-2"
               title="Editar">
              <i class="bi bi-pencil"></i>
            </a>
            <form action="{{ route('users.destroy', $u) }}"
                  method="POST"
                  class="d-inline-block">
              @csrf @method('DELETE')
              <button type="submit"
                      class="text-danger border-0 bg-transparent p-0 m-0 align-baseline"
                      onclick="return confirm('Eliminar este utilizador?')"
                      title="Eliminar">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  

  {{ $users->links() }}
@endsection
