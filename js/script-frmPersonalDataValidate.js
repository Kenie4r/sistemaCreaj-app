//-----     Validación del Formulario de información personal     -----
//Los objetos que se validan
//NOMBRE: que no este vacío y su longitud sea menor de 50
//APELLIDO: que no este vacío y su longitud sea menor de 50
//EMAIL: que no este vacío y cumpla la expresión regular de un email, para lo cúal se apoya con un script externo
//CONTRASEÑA: que no este vacío y sea la actual contraseña, para lo cúal apoya con un script externo

$(document).ready(
    function(){
        //Se configura la validación del form al enviarlo
        $("#btnSubmit").on("click",
            function(){
                validateFormUser();
            }
        )
    }
)

//Función para validar formulario
function validateFormUser() {
    //Variables
    var frmProfile = $("#frmProfile");
    var txtNombre = $("#txtNameProfile");
    var nombre = txtNombre.val();
    var txtApellido = $("#txtLastNameProfile");
    var apellido = txtApellido.val();
    var ckActualPassword = $("#ckActualPass");
    var ckEmail = $("#ckEmail");
    var errores = 0;

    var alertaSending = $("#sending");

    alertaSending.removeClass('hidden'); //Pantalla de carga

    //NOMBRE
    if(nombre == "" || nombre.length > 50){
        errores++;
    }
    //APELLIDO
    if(apellido == "" || apellido.length > 50){
        errores++;
    }
    //CONTRASEÑA
    if( !(ckActualPassword.is(':checked')) ){
        errores++;
    }
    //EMAIL
    if( !(ckEmail.is(':checked')) ){
        errores++;
    }

    //Si hay errores se muestra un alert, sino se continua con la solicitud
    if(errores > 0){
        alertaSending.addClass('hidden'); //Pantalla de carga
        alert("Error: Llene los campos correctamente.");
    }else{
        frmProfile.submit();
    }
}