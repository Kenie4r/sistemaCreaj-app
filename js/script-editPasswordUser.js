$(document).ready(
    function(){
        var txtNewPassword = $("#txtNewPassProfile");
        var txtConfirmPassword = $("#txtConfirmPassProfile");
        var txtActualPassword = $("#txtActualPassProfile");
        var btnSubmit = $("#btnSubmit");

        txtNewPassword.on("input",
            function(){
                validateNewPassword();
            }
        );

        txtConfirmPassword.on("input",
            function(){
                validateNewPassword();
            }
        );

        txtActualPassword.on("input",
            function() {
                var ckActualPassword = $("#ckActualPass");
                var lbActualPassword = $("#lbActualPass");
                var username = $("#actualName").val();

                $.post("../controlador/searchPasswordByUsername.php", 
                    {
                        "username": username,
                        "contra": txtActualPassword.val()
                    },
                    function(respuesta){
                        respuesta = parseInt(respuesta);

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
        );

        btnSubmit.on("click",
            function(){
                validateFrmPass();
            }
        );
    }
);

function validateFrmPass() {
    var frmPassword = $("#frmPassword");
    var ckConfirmPassword = $("#ckConfirmPass"); 
    var ckActualPassword = $("#ckActualPass");
    var errores = 0;
    
    if( !(ckConfirmPassword.is(':checked')) ){
        errores++;
    }

    if( !(ckActualPassword.is(':checked')) ){
        errores++;
    }

    if(errores > 0){
        alert("Error: Llene los campos correctamente.")
    }else{
        frmPassword.submit();
    }
}

function validateNewPassword() {
    var txtConfirmPassword = $("#txtConfirmPassProfile");
    var txtNewPassword = $("#txtNewPassProfile");
    var ckConfirmPassword = $("#ckConfirmPass");
    var lbConfirmPassword = $("#lbConfirmPass");

    if(txtNewPassword.val() == txtConfirmPassword.val() && txtNewPassword.val() != "" ){
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