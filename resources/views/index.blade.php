@extends('layouts/default')

@push('styles')
    @vite(['resources/css/indexStyles.css'])
@endpush

@section('title') Inicio @endsection

@section('content')
<main class="row m-0 p-0">
    <div class="col-9 d-flex flex-column row-gap-4 align-items-center py-3" style="background-color: #FFF">
        <div id="plantillasContainer" class="d-flex flex-column row-gap-4 align-items-center">
            @foreach ($plantillas as $plantilla)
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4 _imgContainer">
                            <img src="{{ asset('storage/plantillas/'.$plantilla->titulo.'/'.$plantilla->img_referencias_visuales) }}" class="w-100 h-100 rounded-start" alt="Imagen referencias visuales">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$plantilla->titulo}}</h5>
                                <p class="card-text parrafoCard">{{$plantilla->descripcion_corta}}</p>
                                <div class="mt-5 text-end">
                                    <a href="{{ route('ver-plantilla', ['titulo'=>$plantilla->titulo]) }}" class="btn btn-primary text-end stretched-link">Ver propuesta</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-3 py-3 d-flex flex-column row-gap-4" style="background-color: #f3f3f3c5">
        <div class="container-fluid d-flex flex-column">
            <h1 class="display-6 m-0">Bienvenido</h1>
            <hr class="mt-0 border border-2 opacity-100" style="border-bottom-color: #24BFD6 !important">
            <div class="d-flex flex-column">
                <img class="img-fluid" src="{{ url('/img/bg-gdd2.jpg') }}" alt="Logo sitio web">
                <span class="mt-2" style="text-align: justify">
                    Un documento de diseño de juego (GDD, por sus siglas en inglés) es un documento de diseño de software que sirve como modelo a partir del cual se construye un videojuego.
                    <br><br>
                    Te ayuda a definir el alcance de tu juego y establece la dirección general del proyecto.
                </span>
            </div>
            
        </div>
        <div class="container-fluid d-flex flex-column">
            <h1 class="display-6 m-0">Acerca de</h1>
            <hr class="mt-0 border border-2 opacity-100" style="border-bottom-color: #24BFD6 !important">
            <a class="btn btn-primary" href="{{ route('acercaDe') }}">Conocenos</a>
        </div>
    </div>
</main>
@endsection