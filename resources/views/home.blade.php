@extends('layouts.app')

@section('title', 'Home')

@section('content')
  <div class="p-5 mb-4 bg-light rounded-3">
    <h1 class="display-5 fw-bold">Bem‑vindo ao Egoi Challenge</h1>
    <p class="col-md-8 fs-4">
      Aqui pode gerir os utilizadores do sistema.
    </p>

    @guest
      <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">Login</a>
      <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg">Registar</a>
    @else
      <div class="fs-5">
        Olá, <strong>{{ Auth::user()->name }}</strong>!
      </div>
      <div class="fs-5 mt-5" >
        <a href="{{ route('users.index') }}" class="btn btn-success">Ver Utilizadores</a>
        </div>
    @endguest
  </div>
@endsection
