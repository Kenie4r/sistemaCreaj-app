$(document).ready(
    function(){
        //Objetos globales
        var txtBusqueda = $("#txtBusquedaId");
        var btnDelete = $(".btn-delete");

        //Filtrar las rubricas segun el textbox busqueda
        txtBusqueda.on("input",
            function(){
                $.post("../controlador/searchRubric.php", 
                    {
                        "idrubric": txtBusqueda.val()

                    },
                    function(respuesta){
                        var contenedorFilasRubric = $("#table-body-rubrica");
                        contenedorFilasRubric.empty();
                        contenedorFilasRubric.html(respuesta);
                    },
                    "html"
                );
            }
        );

        //Confirmar la eliminacion de una rubrica
        btnDelete.on("click",
            function(){
                var estado = confirm("¿Seguro de querer eliminar esta rúbrica?");

                return estado;
            }
        );
    }
)