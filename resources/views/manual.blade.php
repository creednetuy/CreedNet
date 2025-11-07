@extends('template')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Manual del Juego</h3>
    
    <p class="text-center fs-5 mb-5">
        Aquí encontrarás cómo jugar el juego y sus reglas.
    </p>

    <div class="row justify-content-center g-4">
        @foreach (['manual1.jpg', 'manual2.jpg', 'manual3.jpg'] as $img)
            <div class="col-12 col-md-6 col-lg-4 text-center">
                <img src="{{ asset('imagenes/' . $img) }}" class="img-fluid rounded shadow" alt="{{ $img }}" style="cursor:pointer"
                     data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-img="{{ asset('imagenes/' . $img) }}">
            </div>
        @endforeach
    </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0">
        <img id="modalImage" src="" class="img-fluid rounded" alt="Imagen ampliada">
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/manual.js') }}"></script>
@endsection