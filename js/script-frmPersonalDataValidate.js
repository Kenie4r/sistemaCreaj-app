$(document).ready(
    function(){

        $("#txtActualPassProfile").on("input",
            function() {
                confirmPassword();
            }
        )

        $("#btnSubmit").on("click",
            function(){
                validateFormUser();
            }
        )
    }
)

function validateFormUser() {
    var frmProfile = $("#frmProfile");
    var txtNombre = $("#txtNameProfile");
    var nombre = txtNombre.val();
    var txtApellido = $("#txtLastNameProfile");
    var apellido = txtApellido.val();
    var txtEmail = $("#txtEmailProfile");
    var email = txtEmail.val();
    var ckActualPassword = $("#txtActualPassProfile");
    var errores = 0;

    if(nombre == "" || nombre.length > 50){
        errores++;
    }
    if(apellido == "" || apellido.length > 50){
        errores++;
    }
    if( !(ckActualPassword.is(':checked')) ){
        errores++;
    }
    if(!(esEmail(email))){
        errores++;
    }

    if(errores > 0){
        alert("Error: Llene los campos correctamente.");
    }else{
        //frmProfile.submit();
    }
}

function esEmail(email) {
    var estado = false;

    $.post("../controlador/validarEmail.php", 
        {
            "email": email
        },
        function(respuesta){
            estado = respuesta;
            alert(estado);
        }
    );
    alert(estado);
    return estado;
}

function confirmPassword() {
    var ckActualPassword = $("#ckActualPass");
    var lbActualPassword = $("#lbActualPass");
    var txtActualPassword = $("#txtActualPassProfile");
    var username = $("#username").val();

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