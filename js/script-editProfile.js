$(document).ready(
    function(){
        var txtNombre = $("#txtNameProfile");
        var txtApellido = $("#txtLastNameProfile");
        var btnSubmit = $("#btnSubmit");

        txtNombre.on("input",
            function(){
                definirNombreUsuario();
            }
        )
        txtApellido.on("input",
            function(){
                definirNombreUsuario();
            }
        )

        btnSubmit.on("click",
            function(){
                var nombre = $("#txtNameProfile").val();
                var apellido = $("#txtLastNameProfile").val();
                var rol = $("#txtRolProfile").val();
                if(nombre == "" || nombre.length > 50){
                    alert("Error");
                }

                if(apellido == "" || apellido.length > 50){
                    alert("Error");
                }

                if(rol == ""){
                    alert("Error");
                }
                //
                //$("#frmProfile").submit();
            }
        )
    }
)

function definirNombreUsuario() {
    var txtNombre = $("#txtNameProfile");
    var txtApellido = $("#txtLastNameProfile");
    var txtUser = $("#txtUserProfile");
    var user, nombre, apellido;
    nombre = txtNombre.val();
    if( nombre != "" ){
        nombre = nombre.split(' ');
        nombre = nombre[0];
    }else{
        nombre = " ";
    }
    apellido = txtApellido.val();
    if( apellido != ""){
        apellido = apellido.split(' ');
        apellido = apellido[0];
    }else{
        apellido = " ";
    }
    user = nombre.toLowerCase() + "." + apellido.toLowerCase();
    txtUser.val(user);
}