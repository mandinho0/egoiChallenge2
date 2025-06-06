@extends('layouts.app')

@section('content')
  <h2 class="my-4">Editar Utilizador</h2>
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

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-4">Voltar</a>
    <button class="btn btn-primary mt-4">Atualizar</button>
  </form>
@endsection
