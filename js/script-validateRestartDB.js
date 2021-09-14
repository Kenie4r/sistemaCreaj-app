$(document).ready(
    function(){

        //Cuando presiones este boton se ejecutara una validación de su acción
        $("#deleteDB-1").on("click",
            function() {
                mostrarAdvertencia();
            }
        );
    }
)

function mostrarAdvertencia() {
    var alerta = $("#confirmRDB");
    var btnConfirm = $("#deleteDB-2");
    alerta.removeClass('hidden');

    btnConfirm.on("click",
        function(){
            confirmRestart();
        }
    );
}

function confirmRestart() {
    var ckActualPassword = $("#ckActualPass");
    var errores = 0;
    var urlAccess = "../controlador/cleandata.php";
    var urlDenied = "index.php";

    //CONFIRMAR CONTRASEÑA
    if( !(ckActualPassword.is(':checked')) ){
        errores++;
    }

    if(errores > 0){
        alert("ERROR: No se ha validado su identidad.");
        window.location = urlDenied;
    }else{
        window.location = urlAccess;
    }
}