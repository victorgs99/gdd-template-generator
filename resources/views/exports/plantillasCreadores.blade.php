<table>
    <thead>
        <tr>
            <th colspan="10">
                <b>Plantillas</b>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($plantillas as $plantilla)
            <tr>
                <th><b>Creador</b></th>
                <th><b>Título</b></th>
                <th><b>Descripción corta</b></th>
                <th><b>Público dirigido</b></th>
                <th><b>Plataformas de lanzamiento</b></th>
                <th><b>Referencias</b></th>
                <th><b>Palabras clave</b></th>
                @php($i = 1)
                @foreach ($plantilla->mecanicas_juego as $mecanica)
                    <th><b>Descripción mecánica {{$i}}</b></th>
                    @php($i++)
                @endforeach
                @php($i = 1)
            </tr>
            <tr>
                <th><b>{{$plantilla->creador->usuario->name}}</b></th>
                <td>{{$plantilla->titulo}}</td>
                <td>{{$plantilla->descripcion_corta}}</td>
                <td>{{$plantilla->publico_dirigido}}</td>
                <td>
                    @foreach ($plantilla->plataformas_lanzamiento as $plataforma)
                        {{$plataforma->nombre}}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($plantilla->referencias_juego as $referenciaJuego)
                        {{$referenciaJuego->referencia}}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($plantilla->palabras_clave as $palabraClv)
                        {{$palabraClv->palabra}}<br>
                    @endforeach
                </td>
                @foreach ($plantilla->mecanicas_juego as $mecanica)
                    <td>{{$mecanica->descripcion}}</td>
                @endforeach
            </tr>
            <tr></tr>
        @endforeach
    </tbody>
</table>