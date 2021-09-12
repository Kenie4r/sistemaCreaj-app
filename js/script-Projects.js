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
        $("#sltBusqueda").on("change",
            function(){
                $("#txtBusqueda").val("");
                llenarTabla();
            }
        );
    }
)

function llenarTabla() {
    var txtBusqueda = $("#txtBusqueda");
    var tipoBusqueda = $("#sltBusqueda");
    $.post("../controlador/searchProjects.php", 
                    {
                        "filtro": txtBusqueda.val(),
                        "tipofiltro" : tipoBusqueda.val()
                    },
                    function(respuesta){
                        var contenedorFilasRubric = $("#table-body-rubrica");
                        contenedorFilasRubric.empty();
                        contenedorFilasRubric.html(respuesta);
                    },
                    "html"
    );
}