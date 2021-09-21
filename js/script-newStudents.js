$(document).ready(
    function(){
        //Se configura la validación del form al enviarlo
        $("#btnSubmit").on("click",
            function(){
                var nombres = $('#txtNombres').val(), apellidos = $('#txtApellidos').val();
                var codigo = $('#txtCodigo').val(), grado  =$('#txtGrado').val();
                
                if(nombres=="" && codigo=="" && apellidos =="" && grado==""){
                    alert('Aún hay campos por llenar');
                }else{
                    var frmStudents = $("#frmNewStudents");
                    frmStudents.submit();
                }
       
            }
        )
    }
)