$(document).ready(
    function(){
        //Objetos globales
        var txtBusqueda = $("#txtBusqueda");
        var btnDelete = $(".btn-delete");
        var tipoBusqueda = $("#sltBusqueda");

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

        //Confirmar la eliminacion de una rubrica
        btnDelete.on("click",
            function(){
                var estado = confirm("¿Seguro de querer eliminar esta rúbrica?");

                return estado;
            }
        );
    }
)