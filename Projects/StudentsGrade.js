
    $(document).ready(function(){
        $("#txtGrado").change(function(){

            $("#txtGrado opcion:selected").each(function(){
                id= $(this).val();
                $.post("includes/soporteProjectStudens.php",{ id:id
                }, function(data){
                    $("#txtAlumnos").html(data);
                });
            });
        });
    });
