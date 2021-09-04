//-----     Validación del Objeto Actual Password     -----
//CONTRASEÑA: ocupando toda la estructura del input, que la contraseña escrita sea la contraseña actual de usuario

$(document).ready(
    function(){
        //Se configura que cada vez que se escriba se validara la contraseña
        $("#txtActualPassProfile").on("input",
            function() {
                confirmPassword();
            }
        )
    }
)

//Función que a partir de una consulta AJAX verifica la contraseña actual
function confirmPassword() {
    //Variables
    var ckActualPassword = $("#ckActualPass");
    var lbActualPassword = $("#lbActualPass");
    var txtActualPassword = $("#txtActualPassProfile");
    var username = $("#username").val();

    //Solicitud
    $.post("../controlador/searchPasswordByUsername.php", 
        {
            "username": username,
            "contra": txtActualPassword.val()
        },
        function(respuesta){
            respuesta = parseInt(respuesta);
            //Configuración del input
            if(respuesta == 1){
                txtActualPassword.removeClass('focus:border-red-500');
                txtActualPassword.addClass('focus:border-green-500');
                ckActualPassword.prop('checked',true);
                lbActualPassword.removeClass('icon-cross text-red-500');
                lbActualPassword.addClass('icon-checkmark text-green-500');
            }else{
                txtActualPassword.removeClass('focus:border-green-500');
                txtActualPassword.addClass('focus:border-red-500');
                ckActualPassword.prop('checked',false);
                lbActualPassword.removeClass('icon-checkmark text-green-500');
                lbActualPassword.addClass('icon-cross text-red-500');
            }
        }
    );
}