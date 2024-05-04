<table>
    <thead>
        <tr>
            <th colspan="5">
                <b>Datos de contacto de creadores</b>
            </th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th><b>Nombre de usuario</b></th>
            <th><b>Nombre del creador</b></th>
            <th><b>Descripción personal</b></th>
            <th><b>Correo de contacto</b></th>
            <th><b>Teléfono de contacto</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($creadores as $creador)
        <tr>
            <th><b>{{$creador->usuario->name}}</b></th>
            <td>{{$creador->nombre}}</td>
            <td>{{$creador->descripcion_personal}}</td>
            <td>{{$creador->correo_contacto}}</td>
            <td>{{$creador->telefono_contacto}}</td>
        </tr>
        @endforeach
    </tbody>
</table>