$(document).ready(function(){

    recargarlista();

    $('#txtGrado').change(function(){
        recargarlista();
    });
})
function recargarlista(){
    $.ajax({
        type:"POST",
        url:"soportePorjectStudens.php",
        data:"grados=" + $('#txtGrado').val(),
        success:function(r){
            $('#txtAlumnos').html(r);
        }
    })
}