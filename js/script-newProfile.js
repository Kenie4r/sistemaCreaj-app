$(document).ready(
    function(){

        //Cuando escribamos algo en nombre o en apellido, se creara el nombre de usuario
        $("#txtNameProfile").on("input",
            function(){
                definirNombreUsuario();
                validateUsernameInDB();
            }
        )
        $("#txtLastNameProfile").on("input",
            function(){
                definirNombreUsuario();
                validateUsernameInDB();
            }
        )
    }
)

//A partir del nombre y apellido del usuario, creamos su username
function definirNombreUsuario() {
    //variables
    var txtNombre = $("#txtNameProfile");
    var txtApellido = $("#txtLastNameProfile");
    var txtUser = $("#txtUserProfile");
    var nombre = txtNombre.val();
    var apellido = txtApellido.val();
    var user;

    //Vemos si el nombre esta vacío o no
    if( nombre != "" ){
        nombre = nombre.split(' ');
        nombre = nombre[0];
    }else{
        nombre = " ";
    }
    
    //Vemos si el apellido esta vacío o no
    if( apellido != ""){
        apellido = apellido.split(' ');
        apellido = apellido[0];
    }else{
        apellido = " ";
    }

    //A partir de nombre y apellido validado, se crea el nombre de usuario
    user = nombre.toLowerCase() + "." + apellido.toLowerCase();

    //Se escribe ese nombre de usuario en el textbox del username
    txtUser.val(user);
}

//Función para verificar que el nombre de usuario no exista ya en la base de datos
function validateUsernameInDB() {
    //Variables
    var txtUsername = $("#txtUserProfile");
    var username = txtUsername.val();
    var complemento;
    var estado = true;

    //Hacemos una petición AJAX
    $.post("../controlador/getUsersByUsername.php", 
        {
            "nameuser" : username
        },
        function(respuesta){
            //Verificamos si una respuesta coincide con el username
            if(respuesta.length > 0){
                let i = 0;
                //Repetimos todo hasta que el username no sea igual
                while (estado) {
                    complemento = Math.random() * (100 - 1) + 1;
                    complemento = Math.round(complemento);
                    username += complemento;
                    if(username != respuesta[i]["usario"]){
                        estado = false;
                    }
                    i++;
                }
                //Escribimos el nuevo username
                txtUsername.val(username);
            }
        },
        "json"
    );
}