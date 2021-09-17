$(document).ready(
    function(){
        var btnSubmit = $("#btnSubmit"); //El botón para enviar el formulario
        var txtNameRubric = $("#txtNombreRubrica"); //El textbox del nombre de la rubrica

        //FUNCIÓN DE VALIDAR EL NOMBRE DE LA RÚBRICA
        validateNameRubric(txtNameRubric.val());

        txtNameRubric.on("input",
            function(){
                validateNameRubric(txtNameRubric.val());
            }
        );

        //FUNCIÓN DE ENVIAR EL FORMULARIO POR UN A
        btnSubmit.on("click",
            function(){
                formValidate();
            }
        );
    }
)

//Verifica si el formulario esta correcto, para enviarlo
function formValidate(){
    var frmRubric = $("#frmRubric"); //El formulario
    var controladorNameRubric = $("#ckbNameValidate");
    var txtMateriaRubric = $("#txtMateria");
    var txtNivelRubric = $("#txtNivel");
    var errores = 0;
    var criteriosActuales = parseInt($("#siguienteCriterio").val());
    var etiquetaCriterio = "";
    var etiquetaNombreCriterio = "";
    var etiquetaPuntajeCriterio = "";
    var etiquetaDescripcionNivel = "";
    var alertaSending = $("#sending");

    alertaSending.removeClass('hidden'); //Pantalla de carga
    
    //Validacion Rubrica
    if(!(controladorNameRubric.is(':checked'))){
        errores++;
    }else if(txtMateriaRubric.val() == ""){
        errores++;
    }else if(txtNivelRubric.val() == ""){
        errores++;
    }

    //Validacion Criterios
    for (let i = 0; i < criteriosActuales; i++) {
        etiquetaCriterio = "#" + i + "-criterio";
        etiquetaNombreCriterio = "#" + i + "-txtNombreCriterio";
        etiquetaPuntajeCriterio = "#" + i + "-nbPuntaje";

        if( $(etiquetaCriterio).length > 0 ){
            if($(etiquetaNombreCriterio).val() == ""){
                errores++;
            }else if($(etiquetaPuntajeCriterio).val() <= 0){
                errores++;
            }
            for(let j = 0; j < 4; j++){
                etiquetaDescripcionNivel = "#" + i + "-" + j + "-descripcionNivel";
                if($(etiquetaDescripcionNivel).val() == ""){
                    errores++;
                }
            }
        }
    }

    //Ver cuantos errores hay para enviar el formulario
    if(errores > 0){
        alertaSending.addClass('hidden');
        alert("Error: Llene todos los campos.")
    }else{
        frmRubric.submit();
    }
}

//Verifica que el nombre de la rubrica no se repita
function validateNameRubric(title){
    var id = $("#txtID").val();

    $.post("../controlador/searchRubricsByIdAndName.php", 
        {
            "idrubric": id,
            "namerubric" : title
        },
        function(respuesta){
            if(respuesta > 0){
                incorrectNameRubric("Este nombre ya lo tiene una rubrica.");
            }else if(title.length > 45){
                incorrectNameRubric("Los caracteres máximos son de 45.");
            }else if(title.length == 0){
                incorrectNameRubric("Este campo no puede estar vacío.");
            }else{
                correctNameRubric();
            }
        }
    );
}

//Coloca algunos elementos del nombre como incorrecto
function incorrectNameRubric(mensaje) {
    var iconEstado = $("#lbEstadoNR");
    var contenedor = $("#ctNR");
    var mensajeEstado = $("#lbMensajeNR");
    var inputValidate = $("#ckbNameValidate");

    iconEstado.removeClass('icon-checkmark text-green-700');
    iconEstado.addClass('icon-cross text-red-700');
    contenedor.removeClass('border-green-700');
    contenedor.addClass('border-red-700');
    mensajeEstado.removeClass('text-green-700');
    mensajeEstado.addClass('text-red-700');
    mensajeEstado.html(mensaje);
    inputValidate.prop('checked',false);
}

//Coloca algunos elementos del nombre como correcto
function correctNameRubric() {
    var iconEstado = $("#lbEstadoNR");
    var contenedor = $("#ctNR");
    var mensajeEstado = $("#lbMensajeNR");
    var inputValidate = $("#ckbNameValidate");

    iconEstado.removeClass('icon-cross text-red-700');
    iconEstado.addClass('icon-checkmark text-green-700');
    mensajeEstado.html("Nombre válido");
    mensajeEstado.removeClass('text-red-700');
    mensajeEstado.addClass('text-green-700');
    contenedor.removeClass('border-red-700');
    contenedor.addClass('border-green-700');
    inputValidate.prop('checked',true);
}