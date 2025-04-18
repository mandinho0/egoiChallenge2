@extends('layouts.app')

@section('content')
  <h2>Editar Utilizador</h2>
  <form action="{{ route('users.update',$user) }}" method="POST">
    @method('PUT')
    @include('users._form')

    <div class="form-group">
      <label>Nova Senha <small>(opcional)</small></label>
      <input type="password" name="password"
             class="form-control @error('password') is-invalid @enderror">
      @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
      <label>Confirmar Senha</label>
      <input type="password" name="password_confirmation" class="form-control">
    </div>

    <button class="btn btn-primary">Atualizar</button>
  </form>
@endsection
