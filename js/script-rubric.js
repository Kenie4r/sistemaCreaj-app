$(document).ready(
    function(){
        //Objetos globales
        var txtBusqueda = $("#txtBusqueda");
        var tipoBusqueda = $("#sltBusqueda");

        configurarConfirmacionEliminacion();

        //Filtrar las rubricas segun el textbox busqueda
        txtBusqueda.on("input",
            function(){

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
        );

        //Vaciar la busqueda cuando se cambie de tipo de busqueda
        tipoBusqueda.on("change",
            function(){
                txtBusqueda.val("");
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