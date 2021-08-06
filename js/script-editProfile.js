$(document).ready(
    function(){
        var txtNombre = $("#txtNameProfile");
        var txtApellido = $("#txtLastNameProfile");

        txtNombre.on("input",
            function(){
                definirNombreUsuario();
                validateUsernameInDB();
            }
        )
        txtApellido.on("input",
            function(){
                definirNombreUsuario();
                validateUsernameInDB();
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

function validateUsernameInDB() {
    var txtUsername = $("#txtUserProfile");
    var username = txtUsername.val();
    var complemento;
    var estado = true;

    $.post("../controlador/getUsersByUsername.php", 
        {
            "nameuser" : username
        },
        function(respuesta){
            if(respuesta.length > 0){
                let i = 0;
                while (estado) {
                    complemento = Math.random() * (100 - 1) + 1;
                    complemento = Math.round(complemento);
                    username += complemento;
                    if(username != respuesta[i]["usario"]){
                        estado = false;
                    }
                    i++;
                }
                txtUsername.val(username);
            }
        },
        "json"
    );
}