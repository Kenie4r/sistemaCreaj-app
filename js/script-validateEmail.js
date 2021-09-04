//-----     Validación del Objeto Email     -----
//EMAIL: ocupando toda la estructura del input, que el email cumpla con la expresión regular de un correo

$(document).ready(
    function(){

        //Corremos la primera vez la validación de email para configurar ciertas cosas
        validateEmail();

        //Cada vez que se escriba algo en el email será validado
        $("#txtEmailProfile").on("input",
            function() {
                validateEmail();
            }
        );
    }
)

//Esta función ayuda con la validación del input email
function validateEmail() {
    //Variables
    var ckEmail = $("#ckEmail");
    var lbEmail = $("#lbEmail");
    var txtEmail = $("#txtEmailProfile");
    var email = txtEmail.val();
    var patron = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/; //Expresión regular según W3 ORG
    var estadoEmail = false;

    //Comprobamos el email
    estadoEmail = patron.test(email);

    //Configuramos su input según el estado
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