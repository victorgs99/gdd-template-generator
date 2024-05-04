@extends('layouts/default')

@push('styles')
    @vite(['resources/css/utilities.css'])
@endpush

@section('title') Editar perfil @endsection

@section('content')
<main class="row m-0 p-0">
    <div class="col-9 d-flex flex-column align-items-center pt-4 pb-4" style="background-color: #FFF">
        <form class="w-75" method="POST" action="{{ route('edita-datosContacto') }}">
            @csrf
            <h1 class="display-6 m-0 mb-4 text-center">Edita tus datos de contacto</h1>
            <div class="mb-3">
                <label for="inputNombre" class="form-label fs-5">Nombre</label>
                <input type="text" class="form-control" id="inputNombre" name="nombre" value="{{$creador->nombre}}">
            </div>
            <div class="mb-3">
                <label for="inputDescripcionP" class="form-label fs-5">Descripción personal</label>
                <textarea class="form-control" id="inputDescripcionP" name="descripcionPersonal" rows="2" maxlength="190">{{$creador->descripcion_personal}}</textarea>
            </div>
            <div class="mb-3">
                <label for="inputEmail" class="form-label fs-5">Correo electrónico</label>
                <input type="email" class="form-control" id="inputEmail" name="correoContacto" value="{{$creador->correo_contacto}}">
            </div>
            <div class="mb-3">
                <label for="inputTelefono" class="form-label fs-5">Teléfono</label>
                <input type="tel" class="form-control" id="inputTelefono" name="telefonoContacto" value="{{$creador->telefono_contacto}}">
            </div>
            <div class="d-flex justify-content-end mt-4">
                <button class="w-50 btn btn-primary" type="submit">Actualizar datos de contacto</button>
            </div>
        </form>
    </div>
    <div class="col-3 py-3 d-flex flex-column _barraLateral">
        <div class="container-fluid d-flex flex-column">
            <h1 class="display-6 m-0">Consejos</h1>
            <hr class="mt-0 border border-2 opacity-100">
            <li class="mb-3">En el campo <b>nombre</b> puedes agregar tu nombre y un apellido.</li>
            <li class="mb-3">En el campo <b>descripción personal</b> agrega una frase pequeña que describa tu persona.</li>
            <li>En el campo <b>correo y teléfono</b> agrega los cuales estés mas al pendiente en tu día a día.</li>
        </div>
    </div>
</main>
@endsection