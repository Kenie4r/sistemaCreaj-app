$(document).ready(
    function(){
        //V A R I A B L E S   G E N E R A L E S
        var contenedorCriterio = $("#contenedor-criterios"); //Se busca el contenedor de los criterios
        var btnAddCriterio = $("#addCriterio"); //Se busca el botón de añadir criterio

        //C R I T E R I O   P O R   D E F E C T O
        var puntaje1 = $("#0-nbPuntaje"); //Se busca el input puntaje del criterio por defecto

        //Se configura el evento de modificar puntaje en el criterio por defecto
        puntaje1.on("input",
            function(){
                colocarPuntajeTotal( puntaje1 );
            }
        );

        //C R I T E R I O S   N
        //Se configura el evento de agregar criterios
        btnAddCriterio.on("click",
            function(){
                var nCriterios = parseInt($("#nCriterios").val()); //Se busca cual es el número del siguiente criterio y donde se guardan los criterios
                var siguienteCriterio = parseInt( $("#siguienteCriterio").val() );
                var contenedorPuntaje = $("#puntajeTotal"); //Se busca el contenedor del puntaje total de la rúbrica
                var btnDeleteActual = "#" + siguienteCriterio + "-btnDelete"; //Nos ayudará más adelante
                var criterioActual = "#" + siguienteCriterio + "-criterio"; //Nos ayudará más adelante
                var puntajeInput = "#" + siguienteCriterio + "-nbPuntaje"; //Nos ayudará más adelante

                //Se valida el actual puntaje, si es mayor o igual a 100 entonces no se crea
                if( parseInt(contenedorPuntaje.val()) < 100 ){
                    //Si el total no esta completo
                    //Se añade el nuevo criterio
                    contenedorCriterio.append( criterio(siguienteCriterio) );

                    //Se configura el evento del botón eliminar de este criterio
                    $(btnDeleteActual).on("click",
                        function(){
                            restarCriterio( $(puntajeInput) );
                            $(criterioActual).remove();
                            disminuirCriterios(); //Se disminuye el número de criterios
                        }
                    );

                    //Se configura el evento de modificar puntaje en el criterio actual
                    $(puntajeInput).on("input",
                        function(){
                            colocarPuntajeTotal( $(puntajeInput) );
                        }
                    );

                    //Se aumenta el número para el siguiente criterio
                    $("#nCriterios").val( nCriterios + 1 );
                    $("#siguienteCriterio").val( siguienteCriterio + 1 );

                    //Se suma el porcentaje por defecto del nuevo criterio
                    colocarPuntajeTotal( $(puntajeInput) );
                }else{
                    //Si el total ya esta completo no se puede crear un criterio y se le notifica al usuario
                    alert("Error: Ya existen los suficientes criterios para que el porcentaje de la rubrica sea 100%, si es una equivocación por favor revise nuevamente los porcentajes asignados a los criterios.");
                }
            }
        );
    }
)

//Aquí se guarda el contenido html de un criterio
function criterio(numero) {
    var texto = "<div id='" + numero + "-criterio' class='bg-white rounded-lg shadow-lg container'><div class='grid grid-cols-3 m-4'>";
    texto += "<div class='w-full'>";
    texto += "<input type='text' name='" + numero + "-txtNombreCriterio' id='" + numero + "-txtNombreCriterio' value='Criterio " + numero + "' class='w-4/5 outline-none focus:border-gray-800 border-b-2 focus:border-solid'>";
    texto += "<label for='" + numero + "-txtNombreCriterio' title='Editar' class='w-1/5'><span class='icon-pencil'></span></label>";
    texto += "</div>";
    texto += "<div class='w-full'>";
    texto +="<label for='" + numero + "-nbPuntaje' class='w-2/5'>Porcentaje:</label>";
    texto += "<input type='number' name='" + numero + "-nbPuntaje' id='" + numero + "-nbPuntaje' min='0' max='100' value='1' class='w-2/5 outline-none focus:border-gray-800 border-b-2 focus:border-solid'>";
    texto += "<label for='" + numero + "-nbPuntaje' title='Editar' class='w-1/5'><span class='icon-pencil'></span></label>";
    texto += "</div>";
    texto += "<div class='flex justify-end'>";
    texto += "<p id='" + numero + "-btnDelete' title='Eliminar el criterio' class='rounded-full w-8 h-8 flex items-center justify-center text-red-900 border-red-900 border-solid border-2 cursor-pointer'><span class='icon-cross'></span></p>";
    texto += "</div>";
    texto += "</div>";
    texto += "<div id='" + numero + "-nivelesAprobacion' class=''>";
    texto += "<div id='" + numero + "-0-nivelAprobacion' class=''>";
    texto += "<div class='grid grid-cols-3 m-4 border-red-900 border-2 border-solid rounded-lg'>";
    texto += "<div class='flex justify-center items-center border-r-2 border-solid border-red-900'>";
    texto += "<p class='text-red-900 font-bold'>Inicial receptivo</p>";
    texto += "</div>";
    texto += "<textarea name='" + numero + "-0-descripcionNivel' id='" + numero + "-0-descripcionNivel' cols='50' rows='3' class='col-span-2 bg-red-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-red-400 placeholder-black' placeholder='[ Agregar descripción... ]'></textarea>";
    texto += "</div>";
    texto += "</div>";
    texto += "<div id='" + numero + "-1-nivelAprobacion' class=''>";
    texto += "<div class='grid grid-cols-3 m-4 border-yellow-900 border-2 border-solid rounded-lg'>";
    texto += "<div class='flex justify-center items-center border-r-2 border-solid border-yellow-900'>";
    texto += "<p class='text-yellow-900 font-bold'>Básico</p>";
    texto += "</div>";
    texto += "<textarea name='" + numero + "-1-descripcionNivel' id='" + numero + "-1-descripcionNivel' cols='50' rows='3' class='col-span-2 bg-yellow-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-yellow-400 placeholder-black' placeholder='[ Agregar descripción... ]'></textarea>";
    texto += "</div>";
    texto += "</div>";
    texto += "<div id='" + numero + "-2-nivelAprobacion' class=''>";
    texto += "<div class='grid grid-cols-3 m-4 border-blue-900 border-2 border-solid rounded-lg'>";
    texto += "<div class='flex justify-center items-center border-r-2 border-solid border-blue-900'>";
    texto += "<p class='text-blue-900 font-bold'>Autónomo</p>";
    texto += "</div>";
    texto += "<textarea name='" + numero + "-2-descripcionNivel' id='" + numero + "-2-descripcionNivel' cols='50' rows='3' class='col-span-2 bg-blue-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-blue-400 placeholder-black' placeholder='[ Agregar descripción... ]'></textarea>";
    texto += "</div>";
    texto += "</div>";
    texto += "<div id='" + numero + "-3-nivelAprobacion' class=''>";
    texto += "<div class='grid grid-cols-3 m-4 border-green-900 border-2 border-solid rounded-lg'>";
    texto += "<div class='flex justify-center items-center border-r-2 border-solid border-green-900'>";
    texto += "<p class='text-green-900 font-bold'>Estratégico</p>";
    texto += "</div>";
    texto += "<textarea name='" + numero + "-3-descripcionNivel' id='" + numero + "-3-descripcionNivel' cols='50' rows='3' class='col-span-2 bg-green-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-green-400 placeholder-black' placeholder='[ Agregar descripción... ]'></textarea>";
    texto += "</div>";
    texto += "</div>";
    texto += "</div>";
    texto += "</div>";

    return texto;
}

//Coloca el total de los criterios en el input number Total
function colocarPuntajeTotal(inputActual) {
    var cantidadCriterios = parseInt($("#nCriterios").val()); //Debemos saber cuantos criterios existen
    var maximoCriterios = parseInt($("#siguienteCriterio").val()); //Cuantos criterios han existido
    var contenedorPuntaje = $("#puntajeTotal"); //Se busca el contenedor del puntaje total de la rúbrica
    var suma = 0;
    
    //Se calcula el puntaje total según la cantidad de criterios que hay
    if( cantidadCriterios == 1 ){  
        suma = obtenerPuntajeValidado(inputActual);      
        contenedorPuntaje.val( suma );
        seCompletoPuntajeTotal( suma );
    }else if( cantidadCriterios > 1 ){
        suma = sumaCriterios(maximoCriterios);
        corroborarSuma(suma, contenedorPuntaje, inputActual, maximoCriterios);
    }
}

//Devuelve el valor del input number Puntaje validado dentro de los limites permitidos
function obtenerPuntajeValidado(inputPuntaje) {
    var valPuntaje = parseInt(inputPuntaje.val());
    
    if( valPuntaje > 100 ){
        inputPuntaje.val(100);
        valPuntaje = 100;
    }else if( valPuntaje < 1 ){
        inputPuntaje.val(1);
        valPuntaje = 1;
    }else if( valPuntaje == "" ){
        valPuntaje = 1;
    }else if( isNaN(valPuntaje) ){
        valPuntaje = 0;
    }

    return valPuntaje;
}

//Devuelve la suma de todos los puntajes criterios existentes
function sumaCriterios(cantidadCriterios) {
    var suma = 0;
    var puntajeInput = ""; //Nos ayudará más adelante
    var etiquetaCriterio = "";

    for( let i = 0; i < cantidadCriterios; i++ ){
        etiquetaCriterio = "#" + i + "-criterio";
        if($(etiquetaCriterio).length > 0){
            puntajeInput = "#" + i + "-nbPuntaje";
            suma += obtenerPuntajeValidado( $(puntajeInput) );
        }
    }

    return suma;
}

//Corrobora la suma obtenida, si es menor o igual que 100 no hay problema pero si es mayor interviene
function corroborarSuma(suma, contenedorPuntaje, inputActual, cantidadCriterios) {
    if( suma <= 100 ){
        contenedorPuntaje.val( suma );
    }else{
        alert("Se coloco un valor inválido, por favor revise el número que escribio.");
        suma = suma - obtenerPuntajeValidado(inputActual);
        inputActual.val( 100 - suma );
        contenedorPuntaje.val( sumaCriterios(cantidadCriterios) );
    }

    seCompletoPuntajeTotal(suma);
}

//Resta de el total Puntaje, el puntaje de un criterio eliminado
function restarCriterio(inputActual) {
    var puntajeTotal = $("#puntajeTotal"); //Se busca el contenedor del puntaje total de la rúbrica
    var minuendo = parseInt( puntajeTotal.val() );
    var sustraendo = parseInt( inputActual.val() );
    puntajeTotal.val( minuendo - sustraendo );
}

//Disminuye la cantidad de criterios que existen por el momento
function disminuirCriterios() {
    var nCriterios = parseInt($("#nCriterios").val());

    $("#nCriterios").val( nCriterios - 1 );
}

//Muestra un mensaje de completo si la suma de los porcentajes es igual a 100
function seCompletoPuntajeTotal(suma) {
    if( suma == 100 ){
        alert("Felicidades, ha completado el porcentaje máximo de esta rúbrica.");
    }
}