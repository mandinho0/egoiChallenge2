{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('title', 'Login')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="mb-4">Login</h2>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input id="email" type="email" name="email"
                 value="{{ old('email') }}"
                 class="form-control @error('email') is-invalid @enderror" required autofocus>
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
          <input id="password" type="password" name="password"
                 class="form-control @error('password') is-invalid @enderror" required>
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3 form-check">
          <input type="checkbox" name="remember" id="remember"
                 class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
          <label class="form-check-label" for="remember">Manter-me conectado</label>
        </div>

        <button type="submit" class="btn btn-primary">Entrar</button>
        <a href="{{ route('register') }}" class="btn btn-link">Criar conta</a>
      </form>
    </div>
  </div>
@endsection
