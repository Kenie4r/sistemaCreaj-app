var nombre = "";
window.onload = Inicio;
function Inicio(){
    var screen = $('#cargar');

    var userID =$('#hdUserID').val();
    var input =$('#txtNombre');

    



    input.on('input' , function(){
        $.post("../controlador/getprojectsinRate.php",
        {
            "userID" : userID,
            "name" : input.val()
        },
        function (result){
            $('#teamsBox').empty();
            $("#teamsBox").append(result);
        }, "html"
        )


    })
}
