var nombre = "";
window.onload = Inicio;
function Inicio(){
    var screen = $('#cargar');
    ajaxLoad(screen )
    var userID = document.getElementById('hdUserID').value;
    var input = document.getElementById('txtNombre');

    
    input.oninput = function(){
        $.post("../controlador/getprojectsinRate.php",
        {
            "userID" : userID,
            "name" : input.value
        },
        function (result){
            $('#teamsBox').empty();
            $("#teamsBox").append(result);
        }, "html"
        )
    }
}

function ajaxLoad(screen){
    $(document)
    .ajaxStart(function(){
        screen.fadeIn();
    })
    .ajaxStop(function(){
        screen.fadeOut();
    })
}