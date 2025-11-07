@extends('template')

@section('content')
<div class="container my-5">
        <!-- bienvenida -->
        <section class="text-center mb-5">
            <h1 class="display-4 text-primary mb-3">Bienvenido, CreedNet te manda cordiales saludos.</h1>
        </section>

        <!-- Sección -->
        <section class="mb-5">
            <h2 class="h1 text-secondary mb-4">¿Qué es CreedNet?</h2>
            <p class="lead mb-4">
                CreedNet se trata de una empresa dedicada al desarrollo de software, 
                con un perfil que resalta sobre los demás por su seriedad y compromiso, 
                al nivel de analizar y resolver problemas en un corto periodo de tiempo.
            </p>
            <p class="lead">
                CreedNet desarrolla a partir del <strong class="text-info">S.I.G.D.P.</strong> – Sistema Informático de Gestión de Partidas para Draftosaurus, 
                una plataforma pensada para digitalizar el control de partidas del juego de mesa Draftosaurus, 
                facilitando su uso en entornos educativos, lúdicos y de competición. 
                Este sistema permite administrar turnos, registrar jugadas y generar visualizaciones dinámicas 
                del tablero en formato isométrico, adaptado para su uso en navegadores web.
            </p>
        </section>

        <!-- juego -->
        <section class="text-center">
            <h3 class="h2 text-success mb-4">Juego Draftosaurus</h3>
            <p class="lead mb-4">
                En este apartado podrá iniciar en el juego Draftosaurus. Aquí están las opciones de:
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ url('/manual') }}" class="btn btn-primary btn-lg">Manual</a>
                <a href="{{ url('/home') }}" class="btn btn-primary btn-lg">Juego Draftosaurus</a>
                <a href="{{ url('/register') }}" class="btn btn-primary btn-lg">Registrarse</a>

            </div>
        </section>
    </div>

@endsection