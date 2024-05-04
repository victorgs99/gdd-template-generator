<style>
    .pageContainer{
        width: 100%;
        overflow: auto;
    }

    .containerContent{
        text-align: center;
        margin-top: 50px;
    }

    .containerContent::after{
        content: "";
        display: inline-block;
        width: 100%;
    }

    .box{
        display: inline-block;
        background-color: #FFF;
        margin: 10px 1em;
    }

    thead {
        color: #FFF;
        background-color: #000;
    }
    
    tbody {
        background-color: #24BFD6;
    }

    table, th, td {
        border: 1px solid black;
    }
    
    th, td {
        padding: 8px;
    }
</style>

<div class="pageContainer">
    <div style="text-align: center;">
        <img style="" width="500px" src="{{ asset('storage/plantillas/'.$plantilla->titulo.'/'.$plantilla->img_referencias_visuales) }}" alt="Imagen de referencias visuales">
    </div>
    <div style="text-align: center; margin-bottom: 10px; margin-top: 10px;"><b><i>{{$plantilla->titulo}}</i></b></div>
    <div style="text-align: center;"><span>{{$plantilla->descripcion_corta}}</span></div>
    <div class="containerContent">
        <div class="box">
            <table>
                <thead>
                    <tr>
                        <th>Público dirigido</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{$plantilla->publico_dirigido}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="box">
            <table>
                <thead>
                    <tr>
                        <th>Plataformas de lanzamiento</th>
                    </tr>
                </thead>
                <tbody style="text-align: center">
                    @foreach ($plantilla->plataformas_lanzamiento as $plataforma)
                        <tr>
                            <td>{{$plataforma->nombre}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="containerContent">
        <div class="box">
            <table>
                <thead>
                    <tr>
                        <th>Referencias</th>
                    </tr>
                </thead>
                <tbody style="text-align: center">
                    @foreach ($plantilla->referencias_juego as $refJuego)
                        <tr>
                            <td>{{$refJuego->referencia}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box">
            <table>
                <thead>
                    <tr>
                        <th>Palabras clave</th>
                    </tr>
                </thead>
                <tbody style="text-align: center">
                    @foreach ($plantilla->palabras_clave as $palabraClv)
                        <tr>
                            <td>{{$palabraClv->palabra}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div style="margin-top: 100px" class="containerContent">
        @foreach ($plantilla->mecanicas_juego as $mecanica)
            <div class="box">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Mecanica de juego</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center">
                        <tr>
                            <td><img width="200px" src="{{ asset('storage/plantillas/'.$plantilla->titulo.'/'.$mecanica->img) }}" alt="Imagen mecánica de juego"></td>
                            <td>{{$mecanica->descripcion}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>
