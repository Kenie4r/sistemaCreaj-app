$(document).ready(
    function() {
        //Configuramos los botones DELETE por defecto, si los hay
        enableBtnDeleteDefault();

        //Se configura el evento del botón ADD cuando se le de click, para agregar un item
        $("#btnAgregar").on("click",
            function() {
                addItemAsignaciones();
            }
        );
    }
)

//Función para agregar todo un nuevo ítem de asignación
function addItemAsignaciones() {
    var contenedorAsignaciones = $("#contenedor-asignacion"); //Aqui agregaremos el ítem
    //Obtenemos el dato de cuantos contenedores hay creados actualmente
    var cantidadAsignaciones = $("#cantidadAsignaciones");
    var cantidadAInt = parseInt(cantidadAsignaciones.val()); //ID del nuevo contenedor
    //Establecemos la estructura html del nuevo ítem
    var newHtml = itemAsignacion(cantidadAInt);

    //Se añade el nuevo item al contenedor
    contenedorAsignaciones.append(newHtml);

    //Se llenan los select recien creados
    llenarSelectMateria("#" + cantidadAInt + "-sltMateria");
    llenarSelectGrado("#" + cantidadAInt + "-sltGrade");

    //Se configura el botón delete recien creado
    enableBtnDelete(cantidadAInt);

    //Se aumenta la cantidad de asignaciones creados
    cantidadAsignaciones.val(cantidadAInt + 1);
}

//Aquí se guarda el contenido HTML del item de asignacion
function itemAsignacion(numero) {
    var texto = "<div id='" + numero + "-item-asignacion' class='lg:flex lg:flex-row p-4 mb-2 bg-gray-400 rounded-lg'>";
    texto += "<input type='hidden' name='" + numero + "-id-item-asignacion' id='" + numero + "-id-item-asignacion' value=''>";
    texto += "<div class='grid grid-cols-1 lg:grid-cols-2 lg:w-5/6'>";
    texto += "<div>";
    texto += "<div class='flex flex-row items-center w-full mb-7 lg:m-0'>";
    texto += "<label for='" + numero + "-sltMateria' class='p-2'>Materia:</label>";
    texto += "<select name='" + numero + "-sltMateria' id='" + numero + "-sltMateria' maxlength='50' class='p-1 w-full border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none' required>";
    texto += "</select>";
    texto += "</div>";
    texto += "</div>";
    texto += "<div>";
    texto += "<div class='flex flex-row items-center w-full mb-7 lg:m-0'>";
    texto += "<label for='" + numero + "-sltGrade' class='p-2'>Grado:</label>";
    texto += "<select name='" + numero + "-sltGrade' id='" + numero + "-sltGrade' maxlength='50' class='p-1 w-full border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none' required>";
    texto += "</select>";
    texto += "</div>";
    texto += "</div>";
    texto += "</div>";
    texto += "<div class='flex justify-end lg:w-1/6'>";
    texto += "<p id='" + numero + "-btnDelete' title='Eliminar asignación' class='rounded-full w-8 h-8 flex items-center justify-center text-red-900 border-red-900 border-solid border-2 cursor-pointer'><span class='icon-cross'></span></p>";
    texto += "</div>";
    texto += "</div>";

    return texto;          
}

//Función para llenar los select de materia
function llenarSelectMateria(etiqueta) {
    var select = $(etiqueta);
    $.post("../controlador/asignaciones-writeMatter.php", 
        function(respuesta) {
            select.html(respuesta);
        },
        "html"
    );
}

//Función para llenar los select de materia
function llenarSelectGrado(etiqueta) {
    var select = $(etiqueta);
    $.post("../controlador/asignaciones-writeGrade.php", 
        function(respuesta) {
            select.html(respuesta);
        },
        "html"
    );
}

//Función para configurar el botón de DELETE de un itém
function enableBtnDelete(numeroActual) {
    var etiquetaContenedor = "#" + numeroActual + "-item-asignacion";
    var etiquetaBtnDelete = "#" + numeroActual + "-btnDelete";
    var btnD = $(etiquetaBtnDelete);
    btnD.on("click",
        function(){
            $(etiquetaContenedor).remove();
        }
    );
}

//Función para inicializar los botones DELETE por defecto
function enableBtnDeleteDefault() {
    //Cantidades
    var cantidadAsignaciones = $("#cantidadAsignaciones");
    var cantidadAInt = parseInt(cantidadAsignaciones.val());

    if(cantidadAInt > 1){
        for (let i = 1; i < cantidadAInt; i++) {
            enableBtnDelete(i);
        }
    }
}