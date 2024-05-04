$(document).ready(function() {
    const maxInputReferencias = 5;
    const maxInputPalabrasClv = 5;
    const maxInputMecanicas = 3;

    var currentInputReferencias = 1;
    var currentInputPalabrasClv = 1;
    var currentInputMecanicas = 1;

    // Agregar input de referencia
    $('#btn-addReferencia').click(function() {
        if(currentInputReferencias <= maxInputReferencias){
            $('#inputReferenciasContainer').append(
                `<div class="input-group inputReferencia">
                    <input type="text" class="form-control" name="referenciasJuego[]" placeholder="Nombre del juego (año)">
                    <button class="btn btn-outline-danger buttonEliminar" type="button">Eliminar</button>
                </div>`
            );

            currentInputReferencias++;
            activaDesativaBotonAddReferencia();
        }
    });
    
    // Eliminar input de referencia
    $('#inputReferenciasContainer').on('click', '.buttonEliminar', function() {
        $(this).closest('.inputReferencia').remove();

        currentInputReferencias--;
        activaDesativaBotonAddReferencia();
    });

    // Activa/desactiva boton agregar referencia
    function activaDesativaBotonAddReferencia(){
        if(currentInputReferencias == maxInputReferencias)
            $('#btn-addReferencia').hide();
        else
            $('#btn-addReferencia').show();
    }


    // Agregar input de palabra clave
    $('#btn-addPalabraClv').click(function() {
        if(currentInputPalabrasClv <= maxInputPalabrasClv){
            $('#inputPalabrasClvContainer').append(
                `<div class="input-group inputPalabraClv">
                    <input type="text" class="form-control" name="palabrasClave[]" placeholder="Palabra" maxlength="15">
                    <button class="btn btn-outline-danger buttonEliminar" type="button">Eliminar</button>
                </div>`
            );

            currentInputPalabrasClv++;
            activaDesativaBotonAddPalabraClv();
        }
    });
    
    // Eliminar input de palabra clave
    $('#inputPalabrasClvContainer').on('click', '.buttonEliminar', function() {
        $(this).closest('.inputPalabraClv').remove();

        currentInputPalabrasClv--;
        activaDesativaBotonAddPalabraClv();
    });

    // Activa/desactiva boton agregar palabra clave
    function activaDesativaBotonAddPalabraClv(){
        if(currentInputPalabrasClv == maxInputPalabrasClv)
            $('#btn-addPalabraClv').hide();
        else
            $('#btn-addPalabraClv').show();
    }

    // Agregar input de mecánica de juego
    $('#btn-addMecanica').click(function() {
        if(currentInputMecanicas <= maxInputMecanicas){
            $('#inputMecanicasContainer').append(
                `<div class="inputMecanica">
                    <hr class="mt-3 border border-2 opacity-100">
                    <div class="d-flex flex-col justify-content-between">
                        <div class="col-9">
                            <div class="input-group mb-3">
                                <label class="input-group-text">Imagen</label>
                                <input type="file" class="form-control" name="mecanica[`+ currentInputMecanicas +`][img]">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Descripción</span>
                                <textarea class="form-control" name="mecanica[`+ currentInputMecanicas +`][descripcion]" rows="2"></textarea>
                            </div> 
                        </div>
                        <div class="col-2 d-flex justify-content-center align-items-center">
                            <button class="btn btn-outline-danger buttonEliminar" type="button">Eliminar</button>
                        </div>
                    </div>
                </div>`
            );

            currentInputMecanicas++;
            activaDesativaBotonAddMecanica();
        }
    });
    
    // Eliminar input de mecánica de juego
    $('#inputMecanicasContainer').on('click', '.buttonEliminar', function() {
        $(this).closest('.inputMecanica').remove();

        currentInputMecanicas--;
        activaDesativaBotonAddMecanica();
    });

    // Activa/desactiva boton agregar mecánica de juego
    function activaDesativaBotonAddMecanica(){
        if(currentInputMecanicas == maxInputMecanicas)
            $('#btn-addMecanica').hide();
        else
            $('#btn-addMecanica').show();
    }
});