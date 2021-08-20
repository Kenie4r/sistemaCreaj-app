$(document).ready(
    function () {
        
        var txtInput=$("#materia");
        txtInput.on("input",
        function(){
            $.post("../NewMatter.php",{
                "materia":txtInput.val()
            },function (disponible) {
                var respuesta=$("#disponi")
                respuesta.empty()
                respuesta.html(disponible)
            })
        })
    }

)