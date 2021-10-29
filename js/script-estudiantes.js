$(document).ready(
    function(){

        llenartabla();

        //Filtrar las rubricas segun el textbox busqueda
        $("#txtBusqueda").on("input",
            function(){
                llenartabla();
            }
        );

        //Vaciar la busqueda cuando se cambie de tipo de busqueda
        $("#sltBusqueda").on("change",
            function(){
                llenartabla();
            }
        );

        $(".chosen-select").chosen({
            no_results_text: "Sin coincidencias para:",
            disable_search_threshold: 5
        });

        $(".chosen-select").on("change",
            function(){
                llenartabla();
            }
        );
    }
)

//Llenar la tabla de estudiantes con los resultados
function llenartabla() {
    //Variables
    var txtBusqueda = $("#txtBusqueda");
    var tipoBusqueda = $("#sltBusqueda");
    var grado = $("#txtGrado");
    var contenedorFilasRubric = $("#table-body-rubrica");

    //Ajax
    $.post("../controlador/searchEstudiantes.php", 
        {
            "filtro": txtBusqueda.val(),
            "tipo" : tipoBusqueda.val(),
            "grado" : grado.val()
        },
        function(respuesta){
            contenedorFilasRubric.empty();
            contenedorFilasRubric.html(respuesta);
        },
        "html"
    );
}