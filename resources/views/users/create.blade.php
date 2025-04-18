@extends('layouts.app')

@section('content')
  <h2 class="my-4">Criar Utilizador</h2>
  <form action="{{ route('users.store') }}" method="POST">
    @include('users._form')

    <div class="form-group required">
      <label>Senha</label>
      <input type="password" name="password"
             class="form-control @error('password') is-invalid @enderror">
      @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="form-group required">
      <label>Confirmar Senha</label>
      <input type="password" name="password_confirmation" class="form-control  @error('password') is-invalid @enderror">
      @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror

    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-4">Voltar</a>
    <button class="btn btn-success mt-4">Salvar</button>
  </form>
@endsection
