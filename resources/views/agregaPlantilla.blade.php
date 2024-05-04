@extends('layouts/default')

@push('styles')
    @vite(['resources/css/formularioAddModify.css'])
@endpush

@push('custom-scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @vite(['resources/js/funcionalidadAddModify.js'])
@endpush

@section('title') Agregar plantilla @endsection

@section('content')
<main class="row m-0 p-0">
    <div class="col-9 d-flex flex-column align-items-center pt-4 pb-4" style="background-color: #FFF">
        <form class="w-75" method="POST" enctype="multipart/form-data" action="{{ route('crea-plantillaFormulario') }}">
            @csrf
            <h1 class="display-6 m-0 mb-4 text-center">Crea tu plantilla</h1>
            <div class="mb-3">
                <label for="inputTitulo" class="form-label fs-5">Titulo</label>
                <input type="text" class="form-control" id="inputTitulo" name="titulo">
            </div>
            <div class="mb-3">
                <label for="inputDescripcion" class="form-label fs-5">Descripción corta</label>
                <textarea class="form-control" id="inputDescripcion" name="descripcionCorta" rows="3" maxlength="190"></textarea>
            </div>
            <div class="mb-3">
                <label for="inputReferenciaVisuales" class="form-label fs-5">Referencias visuales</label>
                <input class="form-control" type="file" id="inputReferenciaVisuales" name="imgReferenciasVisuales">
            </div>
            <div class="d-flex flex-col justify-content-between mb-3">
                <div class="col-5">
                    <label for="inputPublico" class="form-label fs-5">Público dirigido</label>
                    <textarea class="form-control" id="inputPublico" name="publicoDirigido" rows="2" maxlength="50"></textarea>
                </div>
                <div class="col-6 row-col">
                    <label class="form-label fs-5">Plataformas de lanzamiento</label>
                    <div class="row row-cols-2">
                        @foreach ($plataformas as $plataforma)
                            <div class="col form-check">
                                <input class="form-check-input" type="checkbox" id="inputCheck{{$plataforma->id}}" name="plataformasLanzamiento[]" value="{{$plataforma->id}}">
                                <label class="form-check-label" for="inputCheck{{$plataforma->id}}">
                                    {{$plataforma->nombre}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex flex-col justify-content-between mb-4">
                <div class="col-6">
                    <label class="form-label fs-5">Juegos como referencia</label>
                    <div id="inputReferenciasContainer" class="d-flex flex-column row-gap-2">
                        <div class="input-group inputReferencia">
                            <input type="text" class="form-control" name="referenciasJuego[]" placeholder="Nombre del juego (año)">
                            <button class="btn btn-outline-danger buttonEliminar" type="button" disabled>Eliminar</button>
                        </div>
                    </div>
                    <div class="d-grid mt-2">
                        <button id="btn-addReferencia" class="btn btn-secondary" type="button">Agregar campo</button>
                    </div>
                </div>
                <div class="col-5">
                    <label class="form-label fs-5">Palabras clave</label>
                    <div id="inputPalabrasClvContainer" class="d-flex flex-column row-gap-2">
                        <div class="input-group inputPalabraClv">
                            <input type="text" class="form-control" name="palabrasClave[]" placeholder="Palabra" maxlength="15">
                            <button class="btn btn-outline-danger buttonEliminar" type="button" disabled>Eliminar</button>
                        </div>
                    </div>
                    <div class="d-grid mt-2">
                        <button id="btn-addPalabraClv" class="btn btn-secondary" type="button">Agregar campo</button>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fs-5">Mecánicas de juego</label>
                <div id="inputMecanicasContainer" class="d-flex flex-column row-gap-2">
                    <div class="d-flex flex-col justify-content-between">
                        <div class="col-9">
                            <div class="input-group mb-3">
                                <label class="input-group-text">Imagen</label>
                                <input type="file" class="form-control" name="mecanica[0][img]">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Descripción</span>
                                <textarea class="form-control" name="mecanica[0][descripcion]" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-2 d-flex justify-content-center align-items-center">
                            <button class="btn btn-outline-danger" type="button" disabled>Eliminar</button>
                        </div>
                    </div>
                </div>
                <div class="d-grid mt-3">
                    <button id="btn-addMecanica" class="btn btn-secondary" type="button">Agregar campo</button>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-5">
                <button class="w-50 btn btn-primary" type="submit">Crear plantilla</button>
            </div>
        </form>
    </div>
    <div class="col-3 py-3 d-flex flex-column row-gap-5" style="background-color: #f3f3f3c5">
        <div class="container-fluid d-flex flex-column">
            <h1 class="display-6 m-0">... O puedes importarla</h1>
            <hr class="mt-0 border border-2 opacity-100" style="border-bottom-color: #24BFD6 !important">
            <form method="POST" enctype="multipart/form-data" action="{{ route('crea-plantillaImportacion') }}">
                @csrf
                <div>
                    <label for="inputPlantilla" class="form-label">Plantilla en formato .xlsx</label>
                    <input class="form-control" type="file" id="inputPlantilla" name="plantilla_importada" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button class="btn btn-primary" type="submit">Importar plantilla</button>
                </div>
            </form>
        </div>
        <div class="container-fluid d-flex flex-column">
            <h1 class="display-6 m-0">Instrucciones</h1>
            <hr class="mt-0 border border-2 opacity-100" style="border-bottom-color: #24BFD6 !important">
            <li class="mb-3">Descarga el <b>template de Excel</b> y llenalo con los datos de tu plantilla.</li>
            <li class="mb-3"><b>No modifiques</b> el template ni rellenes la información en el <b>lugar incorrecto.</b>.</li>
            <li>Por el momento <b>no es posible</b> importar las imágenes de tu plantilla, podrás actualizarlas después de agregar la plantilla.</li>
            <div class="d-flex flex-column row-gap-2 mt-3">
                <a class="btn btn-success" href="#">Descargar template</a>
            </div>
        </div>
    </div>
</main>
@endsection