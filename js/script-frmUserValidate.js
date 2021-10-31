//----    Validación del Formulario para crear Usuarios    ----
//Objetos que se validan
//NOMBRE: que no este vacío, no sea un número y su longitud sea menor de 50
//APELLIDO: que no este vacío, no sea un número y su longitud sea menor de 50
//USERNAME: que no este vacío y que no sea solo un punto, se autocompleta a partir de NOMBRE y APELLIDO ocupando un script externo
//EMAIL: que no este vacío y cumpla la expresión regular de un email, para lo cual se usa un script externo
//PASWORD: que no este vacío, se autocompleta por defecto
//ROL: que no este vacío

$(document).ready(
    function(){
        //ROL
        $("#txtRolProfile").on("input",
            function(){
                validateFormUser();
            }
        );

        //NOMBRE
        $("#txtNameProfile").on("input",
            function(){
                validateFormUser();
            }
        );

        //APELLIDO
        $("#txtLastNameProfile").on("input",
            function(){
                validateFormUser();
            }
        );

        //EMAIL
        $("#txtEmailProfile").on("input",
        function() {
            validateFormUser();
        }
    );

        //Cuando se envio el formulario se validará antes de enviar
        $("#btnSubmit").on("click",
            function(){
                submitFormulario();
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
    var ckEstadoFormulario = $("#ckEstadoForm");
    var errores = 0;

    //NOMBRE
    if(nombre == "" || nombre.length > 50 || !isNaN(nombre)){
        errores++;
    }

    //APELLIDO
    if(apellido == "" || apellido.length > 50 || !isNaN(apellido)){
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
    if( !($("#ckEmail").is(':checked')) ){
        errores++;
    }

    //Si hay errores se muestra un alert, sino se procede con la solicitud
    if(errores > 0){
        ckEstadoFormulario.prop('checked', false);
    }else{
        ckEstadoFormulario.prop('checked', true);
    }
}

function submitFormulario() {
    var estadoFormulario = $("#ckEstadoForm");
    var frmProfile = $("#frmProfile");
    var alertaSending = $("#sending");

    if(!(estadoFormulario.is(':checked'))){
        alert("Error: Llene los campos correctamente, recuerde que no permitimos números en los textbox.");
    }else{
        frmProfile.submit();
        alertaSending.removeClass('hidden');
    }
}