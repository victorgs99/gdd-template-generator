@extends('layouts/default')

@push('styles')
    @vite(['resources/css/perfilStyles.css'])
@endpush

@push('custom-scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
@endpush

@section('title') Perfil de {{$creador->usuario->name}}@endsection

@section('content')
<main class="row m-0 p-0">
    <div class="col-9 d-flex flex-column row-gap-4 align-items-center py-3 _minHeight">
        <div id="plantillasContainer" class="d-flex flex-column row-gap-4 align-items-center">
            @if ($plantillas->isEmpty())
                <h1 class="mt-5">¡No has agregado plantillas aun!</h1>
            @else
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
            @endif
        </div>
    </div>
    <div class="col-3 py-3 d-flex flex-column row-gap-5" style="background-color: #f3f3f3c5">
        @if(Route::has('login'))
            @auth
                @if (Auth::user()->creador->id == $creador->id)
                    <div class="container-fluid d-flex flex-column">
                        <h1 class="display-6 m-0">Panel</h1>
                        <hr class="mt-0 border border-2 opacity-100" style="border-bottom-color: #24BFD6 !important">
                        <a class="btn btn-primary" href="{{ route('crear-plantilla') }}">Agregar nueva plantilla</a>
                        @if (Auth::user()->hasRole('admin'))
                            <div class="btn-group dropstart mt-3">
                                <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Exportar plantillas - Excel
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('exporta-plantillaExcel', ['filtro'=>'consola']) }}">Consolas</a></li>
                                    <li><a class="dropdown-item" href="{{ route('exporta-plantillaExcel', ['filtro'=>'movil']) }}">Dispositivos móviles</a></li>
                                    <li><a class="dropdown-item" href="{{ route('exporta-plantillaExcel', ['filtro'=>'pc']) }}">PC</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('exporta-plantillaExcel', ['filtro'=>'general']) }}">Todas las plantillas</a></li>
                                </ul>
                            </div>
                        @endif
                    </div>
                @endif
            @endauth
        @endif
        <div class="container-fluid d-flex flex-column">
            <h1 class="display-6 m-0">Datos de contacto</h1>
            <hr class="mt-0 border border-2 opacity-100" style="border-bottom-color: #24BFD6 !important">
            <div class="d-flex flex-column row-gap-1">
                <div class="d-flex flex-column row-gap-2">
                    <span class="text-start fw-bold">{{$creador->nombre}}</span>
                    <span class="mt-2" style="text-align: justify">
                        @if (is_null($creador->descripcion_personal))
                            ¡No has agregado tu descripción personal!
                        @else
                            {{$creador->descripcion_personal}}
                        @endif
                    </span>
                    <span class="text-end mt-2">{{$creador->correo_contacto}}</span>
                    <span class="text-end mt-2">
                        @if (is_null($creador->telefono_contacto))
                            ¡No has agregado tu teléfono de contacto!
                        @else
                            {{$creador->telefono_contacto}}
                        @endif
                    </span>
                    @if(Route::has('login'))
                        @auth
                            @if (Auth::user()->creador->id == $creador->id)
                                <a class="btn btn-info mt-3" href="{{ route('editar-perfil') }}">Editar datos de contacto</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal plantilla eliminada -->
    <div class="modal fade" id="modalEliminado" tabindex="-1" aria-labelledby="modalEliminadoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEliminadoLabel">Plantilla eliminada</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">¡La plantilla "{{session('nombrePlantillaEliminada')}}" ha sido eliminada con éxito!</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal perfil actualizado -->
    <div class="modal fade" id="modalPerfilActualizado" tabindex="-1" aria-labelledby="modalPerfilActualizadoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalPerfilActualizadoLabel">Perfil actualizado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">¡Los datos de contacto han sido actualizados con éxito!</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    @if(Session::get('bandEliminado'))
        <script>
            $(document).ready(function(){
                $('#modalEliminado').modal('show');
            });
        </script>
    @endif

    @if(Session::get('bandEditado'))
        <script>
            $(document).ready(function(){
                $('#modalPerfilActualizado').modal('show');
            });
        </script>
    @endif
</main>
@endsection