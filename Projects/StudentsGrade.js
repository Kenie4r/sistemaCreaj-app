$(document).ready(function(){

    recargarlista();

    $('#txtGrado').change(function(){
        recargarlista();
    });
})
function recargarlista(){
    $.post("soporteProjectStudens.php", {
        "grados": $('#txtGrado').val()
    },function(result){
          $('#txtAlumnos').empty()
        $('#txtAlumnos').append(result);
    }, "html");
    
}