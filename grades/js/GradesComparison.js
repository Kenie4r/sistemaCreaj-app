window.onload=nivel;
function nivel() {
    document.querySelector('#nivel').onchange=ver;
    document.querySelector('#grado').onkeyup=ver;
    document.querySelector('#seccion').onkeyup=ver;
}
function ver() {
    //ReGrado=false
    //ReSeccion=false
    //ReNivel=false
    niveles=document.querySelector('#nivel').value
    grado=document.querySelector('#grado').value
    seccion=document.querySelector('#seccion').value
    
    if (niveles==""||niveles=="Selecciona") {
       document.querySelector("#te").innerHTML="Escoja una opcion viable"; 
       $("#te").css("color","red");
        ReNivel=false
    }else{
        ReNivel=true
        $("#te").empty();
    }
    if (grado!="") {
        ReGrado=true
        $("#gra").empty();
    }else{
        ReGrado=false
        document.querySelector("#gra").innerHTML="Escribe el Nombre del grado"; 
        $("#gra").css("color","red");
    }
    if (seccion!="") {
        ReSeccion=true
        $("#sec").empty();
    }else{
        ReSeccion=false
        document.querySelector("#sec").innerHTML="Escribe el indice de la seccion"; 
        $("#sec").css("color","red");
    }
    if (ReNivel==true&&ReSeccion==true&&ReGrado==true) {
        $("#guardar").css("background-color","#4f46e5")
        $("#guardar").prop("disabled", false);
    }else{
        $("#guardar").css("background-color","red")
        $("#guardar").prop("disabled", true);
    }
}
