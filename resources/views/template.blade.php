<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>CreedNet - Atlantica y Nieve</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/template.css') }}">
  <link rel="stylesheet" href="{{ asset('css/tablero.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!-- Para íconos -->
</head>

<body class="bg-gradient-ocean text-light">

  <header class="sticky-top bg-gradient-atlantica text-white shadow-lg border-bottom border-info">
    <div class="container d-flex justify-content-between align-items-center py-3">
      
      <!-- Logo -->
      <div class="d-flex align-items-center">
        <img src="{{ asset('imagenes/logocreednet.png') }}" alt="Logo" width="50" height="50" class="rounded-circle shadow-sm border border-light">
        <h1 class="ms-3 mb-0 text-shadow-snow">CreedNet</h1>
      </div>
      
      <!-- Navegación -->
      <nav>
        <div class="d-flex gap-2">
          <a href="{{ url('/') }}" class="btn btn-outline-light btn-sm btn-snow">
            <i class="fas fa-home"></i> Inicio
          </a>
          <a href="{{ url('/home') }}" class="btn btn-outline-light btn-sm btn-snow">
            <i class="fas fa-user"></i> Perfil
          </a>
          <a href="{{ route('ranking') }}" class="btn btn-outline-light btn-sm btn-snow">
            <i class="fas fa-trophy"></i> Ranking
        </a>
        </div>
      </nav>

    </div>
  </header>

  <!-- Main -->
  <main class="container my-4 p-4 bg-snow rounded-4 shadow-lg border border-light">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="bg-gradient-atlantica text-white text-center py-3 mt-4 border-top border-info">
    <div class="container">
      <p class="m-0 text-shadow-snow">
        <i class="fas fa-snowflake"></i> © 2025 - Esto le pertenece a CreedNet <i class="fas fa-water"></i>
      </p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>