@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Usuario: {{$user->name}}</h1>
  <p>Correo electronico: {{$user->email}}</p>
  <form action="{{route('admin-panel.update', $user->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="name" class="form-label">modificar nombre</label>
      <input type="text" name="name" value="{{$user->name}}" class="form-control">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label font-italic">cambiar email</label>
      <input type="email" name="email" value="{{$user->email}}" class="form-control">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label font-italic">cambiar contraseña</label>
      <input type="text" name="password" value="{{$user->password}}" class="form-control"
        placeholder="Modificar la contraseña">
    </div>
    <button type="submit" class="btn btn-primary">Modificar usuario</button>
  </form>

</div>
@endsection