$(document).ready(
    function(){
        //Se configura la validación del form al enviarlo
        $("#btnSubmit").on("click",
            function(){
                var frmStudents = $("#frmParametros");
                frmStudents.submit();
            }
        )
    }
)