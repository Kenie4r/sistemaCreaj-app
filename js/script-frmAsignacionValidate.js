$(document).ready(
    function(){
        var btnSubmit = $("#btnSubmit");
        btnSubmit.on("click",
            function(){
                validateFormUser();
            }
        )
    }
)

function validateFormUser() {
    var frmProfile = $("#frmAsignacion");
    var errores = 0;

    if(errores > 0){
        alert("Error: Llene los campos");
    }else{
        frmProfile.submit();
    }
}