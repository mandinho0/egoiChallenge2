@extends('layouts.app')

@section('content')
  <h2>Criar Utilizador</h2>
  <form action="{{ route('users.store') }}" method="POST">
    @include('users._form')

    <div class="form-group">
      <label>Senha</label>
      <input type="password" name="password"
             class="form-control @error('password') is-invalid @enderror">
      @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
      <label>Confirmar Senha</label>
      <input type="password" name="password_confirmation" class="form-control">
    </div>

    <button class="btn btn-success">Salvar</button>
  </form>
@endsection
