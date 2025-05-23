@extends('layouts.app')

@section('title', 'Registar')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="mb-4">Registar</h2>

      <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <div class="mb-3 required">
          <label for="name" class="form-label">Nome</label>
          <input
            id="name"
            name="name"
            value="{{ old('name') }}"
            class="form-control @error('name') is-invalid @enderror"
          >
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3 required">
          <label for="email" class="form-label">Email</label>
          <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
            class="form-control @error('email') is-invalid @enderror"
          >
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3 required">
          <label for="phone" class="form-label">Telefone</label>
          <input
            id="phone"
            name="phone"
            value="{{ old('phone') }}"
            placeholder="+351912345678"
            class="form-control @error('phone') is-invalid @enderror"
          >
          @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select
            id="role"
            name="role"
            class="form-select @error('role') is-invalid @enderror"
          >
            <option value="user"  {{ old('role')=='user'  ? 'selected' : '' }}>User</option>
            <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
          </select>
          @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3 required">
          <label for="birthday" class="form-label">Data de Nascimento</label>
          <input
            id="birthday"
            type="date"
            name="birthday"
            value="{{ old('birthday') }}"
            max="{{ date('Y-m-d') }}"
            class="form-control @error('birthday') is-invalid @enderror"
          >
          @error('birthday')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3 required">
          <label for="password" class="form-label">Senha</label>
          <input
            id="password"
            type="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
          >
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3 required">
          <label for="password_confirmation" class="form-label">Confirmar Senha</label>
          <input
            id="password_confirmation"
            type="password"
            name="password_confirmation"
            class="form-control @error('password') is-invalid @enderror"
          >
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-success">Registar</button>
        <a href="{{ route('login') }}" class="btn btn-link">Já tenho conta</a>
      </form>
    </div>
  </div>
@endsection
