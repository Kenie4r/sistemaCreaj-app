$(document).ready(
    function(){
        //Objetos globales
        var txtBusqueda = $("#txtBusquedaName");

        //Llenar la tabla de usuarios por primera vez
        llenarTabla();
        configurarConfirmacionEliminacion()

        //Filtrar los perfiles segun el textbox busqueda
        txtBusqueda.on("input",
            function(){
                llenarTabla();
                configurarConfirmacionEliminacion()
            }
        );

        //Confirmar la eliminacion de un perfil
        
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