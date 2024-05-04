@extends('layouts/default')

@push('styles')
    @vite(['resources/css/acercadeStyles.css'])
@endpush

@section('title') Acerca de @endsection

@section('content')
<main class="row m-0 p-0">
    <div class="col-9 d-flex flex-column row-gap-4 align-items-center py-3" style="background-color: #FFF">
        <div class="_cardPrincipal border rounded">
            <img class="card-img-top" src="{{ url('/img/bg-gdd1.jpg') }}" alt="GDD">
            <div class="card-body mb-3">
                <h1 class="display-5 text-center">Plantillas GDD</h1>
                <p class="card-text px-3 fs-5">
                    Este sitio web tiene como objetivo el dar a conocer grandes propuestas para posibles IP,
                    así como poder descargar plantillas sobre tus propias ideas.
                </p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item text-center"><b>Universidad Autónoma de San Luis Potosí</b></li>
                <li class="list-group-item"><b>Materia:</b> Aplicaciones Web Interactivas</li>
                <li class="list-group-item"><b>Realizado por:</b> Victor Manuel Gómez Solis</li>
                <li class="list-group-item"><b>Profesor de la materia:</b> Ing. Estrada Velazquez Francisco Everardo</li>
                <li class="list-group-item d-flex flex-row justify-content-between align-items-center">
                    <b>Enlaces de interés:</b>
                    <div class="d-flex column-gap-2">
                        <a class="btn btn-info" href="https://infocomp.ingenieria.uaslp.mx/cominf/public/alumnos/temarios_doc/2237" target="_blank" rel="noopener noreferrer">Temario de la materia</a>
                        <a class="btn btn-info" href="https://www.uaslp.mx/" target="_blank" rel="noopener noreferrer">Sitio de la UASLP</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
        
    <div class="col-3 py-3 d-flex flex-column row-gap-3" style="background-color: #f3f3f3c5">
        <div class="container-fluid d-flex flex-column">
            <h1 class="display-6 m-0">Créditos a</h1>
            <hr class="mt-0 border border-2 opacity-100" style="border-bottom-color: #24BFD6 !important">
            <div class="d-flex flex-column">
                <span><b>- Por sus imágenes -</b> mamun25g, Game Design With Chris, John</span>
                <br>
                <span><b>- Por formato de plantilla -</b> Mtro. Zain Ángel Ramírez Mendoza</span>
            </div>
        </div>
    </div>
</main>
@endsection