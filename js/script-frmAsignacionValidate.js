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

    //Lamamos a las funciones que nos devuelven la cantidad de select sin datos que hay
    errores += cuantosVaciosSelectMateria();
    errores += cuantosVaciosSelectGrado();

    if(errores > 0){
        alert("Error: Llene los campos");
    }else{
        frmProfile.submit();
    }
}

//Descontinuado
function cuantosVaciosSelectMateria() {
    var cantidadAsignaciones = $("#cantidadAsignaciones");
    var numeroDeAssign = parseInt(cantidadAsignaciones.val());
    var errores = 0;
    var etiquetaMateria = "";

    for (let i = 0; i < numeroDeAssign; i++) {
        etiquetaMateria = "#" + i + "-sltMateria";
    
        if($(etiquetaMateria).length > 0){
            if($(etiquetaMateria).val() == ""){
                errores++;
            }
        }
    }

    return errores;
}

//Descontinuado
function cuantosVaciosSelectGrado() {
    var cantidadAsignaciones = $("#cantidadAsignaciones");
    var numeroDeAssign = parseInt(cantidadAsignaciones.val());
    var etiquetaGrado = "";
    var errores = 0;

    for (let i = 0; i < numeroDeAssign; i++) {
        etiquetaGrado = "#" + i + "-sltGrade";
        
        if($(etiquetaGrado).length > 0){
            if($(etiquetaGrado).val() == ""){
                errores++;
            }
        }
    }

    return errores;
}