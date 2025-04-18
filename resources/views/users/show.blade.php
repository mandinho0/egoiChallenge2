@extends('layouts.app')

@section('content')
  <h2>Detalhes do Utilizador: {{ $user->name }}</h2>
  <ul class="list-group">
    <li class="list-group-item"><strong>Nome:</strong> {{ $user->name }}</li>
    <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
    <li class="list-group-item"><strong>Telefone:</strong> {{ $user->phone }}</li>
    <li class="list-group-item">
      <strong>Data de Nascimento:</strong>
      {{ $user->birthday?->format('d/m/Y') }}
    </li>
    <li class="list-group-item"><strong>Role:</strong> {{ ucfirst($user->role) }}</li>
  </ul>
  <a href="{{ route('users.index') }}" class="btn btn-secondary mt-4">Voltar</a>
@endsection
