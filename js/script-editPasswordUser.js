//-----     Validación del Formulario de Actualizar Contraseña     -----
//Objetos que se validan
//NEW PASSWORD: que no este vacío
//CONFIRM NEW PASSWORD: que coincida con la NEW PASSWORD y que no este vacío
//ACTUAL PASSWORD: que coincida con la contraseña actual del usuario, usando un script externo

$(document).ready(
    function(){
        $("a").on("click",
            function() {
                var btnCancelar = $("#btnCancelar");
                var estado = true;

                if(btnCancelar.length > 0){
                    estado = true;
                }else{
                    estado = false;
                    alert("ERROR: Debe cambiar la contraseña para asegurar su cuenta, no puede ser la misma que por defecto.");
                }

                return estado;
            }
        );
        //Configuramos la validación de NEW PASSWORD
        $("#txtNewPassProfile").on("input",
            function(){
                validateNewPassword();
            }
        );
        //Configuramos la validación de CONFIRM NEW PASSWORD
        $("#txtConfirmPassProfile").on("input",
            function(){
                validateNewPassword();
            }
        );
        //Cuando se envie el formulario se verificarán los objetos
        $("#btnSubmit").on("click",
            function(){
                validateFrmPass();
            }
        );
    }
);

//Función para validar el formulario
function validateFrmPass() {
    //Variables
    var frmPassword = $("#frmPassword");
    var ckConfirmPassword = $("#ckConfirmPass"); 
    var ckActualPassword = $("#ckActualPass");
    var errores = 0;
    var alertaSending = $("#sending");

    alertaSending.removeClass('hidden'); //Pantalla de carga
    
    //CONFIRM PASSWORD
    if( !(ckConfirmPassword.is(':checked')) ){
        errores++;
    }
    //ACTUAL PASSWORD
    if( !(ckActualPassword.is(':checked')) ){
        errores++;
    }

    //Si hay errores se mestra un alert, sino se procede con la solicitud
    if(errores > 0){
        alert("Error: Llene los campos correctamente.")
    }else{
        frmPassword.submit();
    }
}

//Función para validar que coincidan NEW PASSWORD y CONFIRM NEW PASSWORD
function validateNewPassword() {
    //Variables
    var txtConfirmPassword = $("#txtConfirmPassProfile");
    var txtNewPassword = $("#txtNewPassProfile");
    var ckConfirmPassword = $("#ckConfirmPass");
    var lbConfirmPassword = $("#lbConfirmPass");

    //Commparación
    if(txtNewPassword.val() == txtConfirmPassword.val() && txtNewPassword.val() != "" &&  txtNewPassword.val() != "donboscoSV"){
        ckConfirmPassword.prop('checked',true);
        txtConfirmPassword.removeClass('focus:border-red-500');
        lbConfirmPassword.removeClass('text-red-500 icon-cross');
        txtConfirmPassword.addClass('focus:border-green-500');
        lbConfirmPassword.addClass('text-green-500 icon-checkmark');
    }else{
        ckConfirmPassword.prop('checked', false);
        txtConfirmPassword.removeClass('focus:border-green-500');
        lbConfirmPassword.removeClass('text-green-500 icon-checkmark');
        txtConfirmPassword.addClass('focus:border-red-500');
        lbConfirmPassword.addClass('text-red-500 icon-cross');
    }
}