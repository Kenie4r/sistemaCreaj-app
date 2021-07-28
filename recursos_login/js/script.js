function Iniciar(){
    var BOTON = document.getElementById("cambiarType");
    BOTON.innerHTML = "<span class=\"icon-eye\"></span>";
}
function cambiar01(){
    var input = document.getElementById("text02");
    var BOTON = document.getElementById("cambiarType");
    tipo = input.type;
    if(tipo == "password"){
        input.type = 'texto';
        BOTON.innerHTML = "<span class=\"icon-eye-blocked\"></span>";
    }else{
        input.type = 'password';
        BOTON.innerHTML = "<span class=\"icon-eye\"></span>";
    }
}