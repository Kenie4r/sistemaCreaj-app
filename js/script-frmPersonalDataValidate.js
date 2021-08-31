$(document).ready(
    function(){
        validateEmail();

        $("#txtEmailProfile").on("input",
            function() {
                validateEmail();
            }
        );

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
    var ckActualPassword = $("#ckActualPass");
    var ckEmail = $("#ckEmail");
    var errores = 0;

    if(nombre == "" || nombre.length > 50){
        errores++;
    }
    if(apellido == "" || apellido.length > 50){
        errores++;
    }
    if( !(ckActualPassword.is(':checked')) ){
        errores++;
        alert(3);
    }

    if( !(ckEmail.is(':checked')) ){
        errores++;
    }

    if(errores > 0){
        alert("Error: Llene los campos correctamente.");
        alert(errores);
    }else{
        frmProfile.submit();
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

function validateEmail() {
    var ckEmail = $("#ckEmail");
    var lbEmail = $("#lbEmail");
    var txtEmail = $("#txtEmailProfile");
    var email = txtEmail.val();
    var patron = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/; //Expresión regular según W3 ORG
    var estadoEmail = false;

    estadoEmail = patron.test(email);

    if(estadoEmail){
        txtEmail.removeClass('focus:border-red-500');
        txtEmail.addClass('focus:border-green-500');
        ckEmail.prop('checked',true);
        lbEmail.removeClass('icon-cross text-red-500');
        lbEmail.addClass('icon-checkmark text-green-500');
    }else{
        txtEmail.removeClass('focus:border-green-500');
        txtEmail.addClass('focus:border-red-500');
        ckEmail.prop('checked',false);
        lbEmail.removeClass('icon-checkmark text-green-500');
        lbEmail.addClass('icon-cross text-red-500');
    }
}