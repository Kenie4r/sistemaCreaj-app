$(document).ready(
    function(){
        //Objetos globales
        var txtBusqueda = $("#txtBusquedaName");
        var btnDelete = $(".btn-delete");

        //Filtrar los perfiles segun el textbox busqueda
        txtBusqueda.on("input",
            function(){
                $.post("../controlador/searchUser.php", 
                    {
                        "nameUser": txtBusqueda.val()
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

        //Confirmar la eliminacion de un perfil
        btnDelete.on("click",
            function(){
                var estado = confirm("¿Seguro de querer eliminar este perfil?");

                return estado;
            }
        );
    }
)