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
                llenarTabla();
            }
        );
    }
)

//Función para confirmar la eliminación de un usuario
function configurarConfirmacionEliminacion() {
    var btnDelete = $(".btn-delete");

    btnDelete.on("click",
        function(){
            var estado = confirm("¿Seguro de querer eliminar esta rubrica?");
            
            return estado;
        }
    );
}

function llenarTabla() {
    //Objetos globales
    var txtBusqueda = $("#txtBusqueda");
    var tipoBusqueda = $("#sltBusqueda");

    $.post("../controlador/searchRubric.php", 
                    {
                        "filtrorubric": txtBusqueda.val(),
                        "tiporubric" : tipoBusqueda.val()
                    },
                    function(respuesta){
                        var contenedorFilasRubric = $("#table-body-rubrica");
                        contenedorFilasRubric.empty();
                        contenedorFilasRubric.html(respuesta);
                        configurarConfirmacionEliminacion();
                    },
                    "html"
    );
}