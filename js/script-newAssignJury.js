$(document).ready(
    function() {
        var btnAgregar = $("#btnAgregar");
        var cantidadAsignaciones = $("#cantidadAsignaciones");

        btnAgregar.on("click",
            function() {
                contenedorAsignacion(cantidadAsignaciones.val());
                cantidadAsignaciones.val(cantidadAsignaciones.val() + 1);
            }
        );
    }
)

function contenedorAsignacion(numero) {
    var texto;
    texto += "<div id='" + numero + "-item-asignacion' class='grid grid-cols-1 lg:grid-cols-2 p-4 mb-2 bg-gray-400 rounded-lg'>";
    texto += "<div>";
    texto += "<div class='flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0'>";
    texto += "<label for='" + numero + "-sltMateria' class='p-2'>Materia:</label>";
    texto += "<select name='" + numero + "-sltMateria' id='" + numero + "-sltMateria' maxlength='50' class='p-1 w-full border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none' required>";
    
    texto += "</select>";
    texto += "</div>";
    texto += "</div>";
    texto += "<div>";
    texto += "<div class=''flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0'>";
    texto += "<label for='" + numero + "-sltGrade' class='p-2'>Grado:</label>";
    texto += "<select name='" + numero + "-sltGrade' id='" + numero + "-sltGrade' maxlength='50' class='p-1 w-full border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none' required>";

    texto += "</select>";
    texto += "</div>";
    texto += "</div>";
    texto += "</div>";

    return texto;          
}