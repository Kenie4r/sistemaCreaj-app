$(document).ready(
    function(){
        llenarTabla();

        //Filtrar las rubricas segun el textbox busqueda
        $("#txtBusqueda").on("input",
            function(){
                llenarTabla();
            }
        );

        //Vaciar la busqueda cuando se cambie de tipo de busqueda
        $("#txtMateria").on("change",
            function(){
                llenarTabla();
            }
        );

        //Vaciar la busqueda cuando se cambie de tipo de busqueda
        $("#txtNivel").on("change",
            function(){
                llenarTabla();
            }
        );

        $(".chosen-select").chosen(
            {no_results_text: "Sin coincidencias para:"}
        );
    }
)

function llenarTabla() {
    var busquedaNombre = $("#txtBusqueda");
    var busquedaMateria = $("#txtMateria");
    var busquedaGrado = $("#txtNivel");
    var contenedorTabla = $("#table-body");

    $.post("../controlador/searchProjects.php", 
                    {
                        "nombre": busquedaNombre.val(),
                        "materia" : busquedaMateria.val(),
                        "grado": busquedaGrado.val()
                    },
                    function(respuesta){
                        contenedorTabla.empty();
                        contenedorTabla.html(respuesta);
                    },
                    "html"
    );
}