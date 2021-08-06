$(document).ready(
    function(){
        var frmProfile = $("#frmProfile");
        var btnSubmit = $("#btnSubmit");

        btnSubmit.on("click",
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

    if(errores > 0){
        alert("Error: Llene los campos");
    }else{
        frmProfile.submit();
    }
}