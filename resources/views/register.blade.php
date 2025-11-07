@extends('template')

@section('content')
<div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4 bg-snow text-dark">
                <div class="card-header bg-gradient-atlantica text-white text-center rounded-top-4">
                    <h3 class="mb-0 text-shadow-snow">
                        <i class="fas fa-user-plus"></i> Registrarse
                    </h3>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success rounded-pill">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger rounded-pill">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label text-muted">
                                    <i class="fas fa-user"></i> Nombre Completo
                                </label>
                                <input type="text" name="name" id="name" class="form-control rounded-pill border-info" required value="{{ old('name') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label text-muted">
                                    <i class="fas fa-envelope"></i> Correo Electrónico
                                </label>
                                <input type="email" name="email" id="email" class="form-control rounded-pill border-info" required value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label text-muted">
                                    <i class="fas fa-lock"></i> Contraseña
                                </label>
                                <input type="password" name="password" id="password" class="form-control rounded-pill border-info" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label text-muted">
                                    <i class="fas fa-lock"></i> Confirmar Contraseña
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-pill border-info" required>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success rounded-pill shadow">
                                <i class="fas fa-check-circle"></i> Crear Cuenta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection