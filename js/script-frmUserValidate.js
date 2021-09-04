//----    Validación del Formulario para crear Usuarios    ----
//Objetos que se validan
//NOMBRE: que no este vacío y su longitud sea menor de 50
//APELLIDO: que no este vacío y su longitud sea menor de 50
//USERNAME: que no este vacío y que no sea solo un punto, se autocompleta a partir de NOMBRE y APELLIDO
//EMAIL: que no este vacío y cumpla la expresión regular de un email
//PASWORD: que no este vacío, se autocompleta por defecto
//ROL: que no este vacío

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

        //Cuando se envio el formulario se validará antes de enviar
        $("#btnSubmit").on("click",
            function(){
                validateFormUser();
            }
        )
    }
)

//Función para validar todo el formulario
function validateFormUser() {
    //Variables
    var nombre = $("#txtNameProfile").val();
    var apellido = $("#txtLastNameProfile").val();
    var rol = $("#txtRolProfile").val();
    var username = $("#txtUserProfile").val();
    var ckEmail = $("#ckEmail");
    var errores = 0;

    //NOMBRE
    if(nombre == "" || nombre.length > 50){
        errores++;
    }

    //APELLIDO
    if(apellido == "" || apellido.length > 50){
        errores++;
    }

    //ROL
    if(rol == ""){
        errores++;
    }

    //USERNAME
    if(username == "" || username == "."){
        errores++;
    }

    //EMAIL
    if( !(ckEmail.is(':checked')) ){
        errores++;
    }

    //Si hay errores se muestra un alert, sino se procede con la solicitud
    if(errores > 0){
        alert("Error: Llene los campos");
    }else{
        frmProfile.submit();
    }
}

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