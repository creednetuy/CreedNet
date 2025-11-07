@extends('template')

@section('content')
 <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0 rounded-4 bg-snow text-dark">
                <div class="card-header bg-gradient-atlantica text-white text-center rounded-top-4">
                    <h3 class="mb-0 text-shadow-snow">
                        <i class="fas fa-user-circle"></i> Iniciar Sesión
                    </h3>
                </div>
                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger rounded-pill">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label text-muted">
                                <i class="fas fa-envelope"></i> Correo Electrónico
                            </label>
                            <input type="email" name="email" id="email" class="form-control rounded-pill border-info" placeholder="ejemplo@correo.com" required value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label text-muted">
                                <i class="fas fa-lock"></i> Contraseña
                            </label>
                            <input type="password" name="password" id="password" class="form-control rounded-pill border-info" placeholder="••••••••" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill shadow">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                            </button>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection