//-----     Validación del Formulario de Asignaciones a jurados
//Objetos a validar
//MATERIAS: que todos los input materia no esten vacíos
//GRADOS: que todos los input grado no esten vacíos

$(document).ready(
    function(){
        //Configuramos el evento enviar
        $("#btnSubmit").on("click",
            function(){
                validateFormUser();
            }
        )
    }
)

function validateFormUser() {
    //Variables
    var frmProfile = $("#frmAsignacion");
    var errores = 0;

    //Lamamos a las funciones que nos devuelven la cantidad de select sin datos que hay
    errores += cuantosVaciosSelectMateria(); //MAETIRAS
    errores += cuantosVaciosSelectGrado(); //GRADOS

    //Dependiendo de los errores imprimimos una alert, o procesamos la solicitud
    if(errores > 0){
        alert("Error: Llene los campos");
    }else{
        frmProfile.submit();
    }
}

//Función para averiguar cuantos input materia creados están vacíos
function cuantosVaciosSelectMateria() {
    //Variables
    var cantidadAsignaciones = $("#cantidadAsignaciones");
    var numeroDeAssign = parseInt(cantidadAsignaciones.val());
    var errores = 0;
    var etiquetaMateria = "";

    //Recorremos las asignaciones creadas
    for (let i = 0; i < numeroDeAssign; i++) {
        etiquetaMateria = "#" + i + "-sltMateria";
        //Verificamos que si exista y no este eliminada
        if($(etiquetaMateria).length > 0){
            if($(etiquetaMateria).val() == ""){
                errores++;
            }
        }
    }

    return errores;
}

//Función para averiguar cuantos input grado creados están vacíos
function cuantosVaciosSelectGrado() {
    //Variables
    var cantidadAsignaciones = $("#cantidadAsignaciones");
    var numeroDeAssign = parseInt(cantidadAsignaciones.val());
    var etiquetaGrado = "";
    var errores = 0;

//Recorremos las asignaciones creadas
    for (let i = 0; i < numeroDeAssign; i++) {
        etiquetaGrado = "#" + i + "-sltGrade";
        //Verificamos que si exista y no este eliminada
        if($(etiquetaGrado).length > 0){
            if($(etiquetaGrado).val() == ""){
                errores++;
            }
        }
    }

    return errores;
}