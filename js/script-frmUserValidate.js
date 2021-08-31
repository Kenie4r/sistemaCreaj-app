$(document).ready(
    function(){

        validateEmail();

        $("#txtEmailProfile").on("input",
            function() {
                validateEmail();
            }
        );

        $("#btnSubmit").on("click",
            function(){
                validateFormUser();
            }
        )
    }
)

function validateFormUser() {
    var nombre = $("#txtNameProfile").val();
    var apellido = $("#txtLastNameProfile").val();
    var rol = $("#txtRolProfile").val();
    var username = $("#txtUserProfile").val();
    var ckEmail = $("#ckEmail");
    var errores = 0;

    if(nombre == "" || nombre.length > 50){
        errores++;
    }
    if(apellido == "" || apellido.length > 50){
        errores++;
    }
    if(rol == ""){
        errores++;
    }
    if(username == "" || username == "."){
        errores++;
    }
    if( !(ckEmail.is(':checked')) ){
        errores++;
    }

    if(errores > 0){
        alert("Error: Llene los campos");
    }else{
        frmProfile.submit();
    }
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