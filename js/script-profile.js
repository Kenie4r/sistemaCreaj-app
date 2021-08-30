$(document).ready(
    function(){

        //Llenar la tabla de usuarios por primera vez
        llenarTabla();

        //Filtrar los perfiles segun el textbox busqueda
        $("#txtBusquedaName").on("input",
            function(){
                llenarTabla();
            }
        );

        //Vaciar la busqueda cuando se cambie de tipo de busqueda
        $("#txtBusquedaName").on("change",
            function(){
                llenarTabla();
            }
        );
        
    }
)

//Función para llenar la tabla de usuarios según un filtro
//Si el filtro esta vacío se coloca todos
function llenarTabla() {
    var txtBusqueda = $("#txtBusquedaName");
    var tipoBusqueda = $("#sltBusqueda").val();

    $.post("../controlador/searchUser.php", 
        {
            "filtro": txtBusqueda.val(),
            "tipoBusqueda": tipoBusqueda
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

//Función para confirmar la eliminación de un usuario
function configurarConfirmacionEliminacion() {
    var btnDelete = $(".btn-delete");

    btnDelete.on("click",
        function(){
            var estado = confirm("¿Seguro de querer eliminar este perfil?");
            
            return estado;
        }
    );
}