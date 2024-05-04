@extends('layouts/default')

@push('styles')
    @vite(['resources/css/plantillaStyles.css'])
@endpush

@section('title') {{$plantilla->titulo}} @endsection

@section('content')
<main class="row m-0 p-0">
    <div class="col-9 d-flex flex-column row-gap-4 align-items-center py-3" style="background-color: #FFF">
        <div class="card" style="width: 80%;">
            <img height="300px" src="{{ asset('storage/plantillas/'.$plantilla->titulo.'/'.$plantilla->img_referencias_visuales) }}" class="card-img-top" alt="Imagen de referencias visuales">
            <div class="card-header _headerTitle text-center fs-5">{{$plantilla->titulo}}</div>
            <div class="card-body d-flex flex-column row-gap-4">
                <p class="card-text">{{$plantilla->descripcion_corta}}</p>
                <div class="w-100 d-flex flex-row justify-content-between">
                    <div class="col-4">
                        <div class="card-header _headerBody text-center">Público dirigido</div>
                        <div class="card-body">{{$plantilla->publico_dirigido}}</div>
                    </div>
                    <div class="col-7">
                        <div class="card-header _headerBody text-center">Plataformas de lanzamiento</div>
                        <div class="card-body d-flex flex-wrap flex-row row-gap-2 column-gap-2 justify-content-center">
                            @foreach($plantilla->plataformas_lanzamiento as $plataforma)
                                <div class="card _cardPlataforma">
                                    <img height="75px" src="{{ url('/img/'.$plataforma->img) }}" class="card-img-top" alt="Imagen de plataforma">
                                    <div class="card-body p-2 text-center">
                                        <h6 class="card-title m-0">{{$plataforma->nombre}}</h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="w-100 d-flex flex-row justify-content-between">
                    <div class="col-7">
                        <div class="card-header _headerBody text-center">
                            Referencias
                        </div>
                        <div class="card-body">
                            <table class="table table-sm m-0">
                                <tbody>
                                    @foreach($plantilla->referencias_juego as $referenciaJuego)
                                        <tr>
                                            <td scope="row">{{$referenciaJuego->referencia}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card-header _headerBody text-center">
                            Palabras clave
                        </div>
                        <div class="card-body">
                            <table class="table table-sm m-0">
                                <tbody class="text-center">
                                    @foreach($plantilla->palabras_clave as $palabraClv)
                                        <tr>
                                            <td scope="row">{{$palabraClv->palabra}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--Carrusel de mecánicas de juego-->
                <div class="w-100 d-flex flex-column align-items-center">
                    <div class="card-header _headerBody text-center" style="width: 85%">Mécanicas de juego más llamativas</div>
                    <div id="carouselMecanicasJuego" class="carousel slide" style="width: 85%">
                        <div class="carousel-indicators">
                            @php($i = 0)
                            @foreach ($plantilla->mecanicas_juego as $mecanica)
                                @if ($i == 0)
                                    <button type="button" data-bs-target="#carouselMecanicasJuego" data-bs-slide-to="{{$i}}" class="active"></button>
                                @else
                                    <button type="button" data-bs-target="#carouselMecanicasJuego" data-bs-slide-to="{{$i}}"></button>
                                @endif
                                @php($i++)
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @php($i = 0)
                            @foreach ($plantilla->mecanicas_juego as $mecanica)
                                @if ($i == 0)
                                    <div class="carousel-item active">
                                @else
                                    <div class="carousel-item">
                                @endif
                                        <img src="{{ asset('storage/plantillas/'.$plantilla->titulo.'/'.$mecanica->img) }}" class="d-block w-100 h-100" alt="Imagen mecánica de juego">
                                        <div class="carousel-caption d-none d-md-block">
                                            <p class="fst-italic fs-5">{{$mecanica->descripcion}}</p>
                                        </div>
                                    </div>
                                @php($i++)
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselMecanicasJuego" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselMecanicasJuego" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 py-3 d-flex flex-column row-gap-5" style="background-color: #f3f3f3c5">
        <div class="container-fluid d-flex flex-column">
            <h1 class="display-6 m-0">Ficha del creador</h1>
            <hr class="mt-0 border border-2 opacity-100" style="border-bottom-color: #24BFD6 !important">
            <div class="d-flex flex-column row-gap-1">
                <div class="d-flex flex-column row-gap-2">
                    <span class="text-start fw-bold">{{$plantilla->creador->nombre}}</span>
                    <span class="mt-2" style="text-align: justify">
                        @if (is_null($plantilla->creador->descripcion_personal))
                            Sin descripción personal
                        @else
                            {{$plantilla->creador->descripcion_personal}}
                        @endif
                    </span>
                    <span class="text-end mt-2">{{$plantilla->creador->correo_contacto}}</span>
                    <span class="text-end mt-2">
                        @if (is_null($plantilla->creador->telefono_contacto))
                            Sin teléfono de contacto
                        @else
                            {{$plantilla->creador->telefono_contacto}}
                        @endif
                    </span>
                    @if(Route::has('login'))
                        @auth
                            @if (Auth::user()->creador->id != $plantilla->creador->id)
                                <a class="btn btn-info mt-3" href="{{ route('carga-perfil', ['usuario'=>$plantilla->creador->usuario->name]) }}">Visitar perfil</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
        @if(Route::has('login'))
            @auth
                <div class="container-fluid d-flex flex-column">
                    <h1 class="display-6 m-0">Opciones</h1>
                    <hr class="mt-0 border border-2 opacity-100" style="border-bottom-color: #24BFD6 !important">
                    <div class="d-flex flex-column row-gap-2">
                        @if (Auth::user()->creador->id == $plantilla->creador->id)
                            <!--<a class="btn btn-warning" href="#">Modificar</a>-->
                            <a class="btn btn-danger" href="{{ route('elimina-plantilla', ['id'=>$plantilla->id]) }}">Eliminar</a>
                        @endif
                        <a class="btn btn-success" href="{{ route('exporta-plantillaPdf', ['id'=>$plantilla->id]) }}">Exportar plantilla en PDF</a>
                    </div>
                </div>
            @endauth
        @endif
    </div>
</main>
@endsection