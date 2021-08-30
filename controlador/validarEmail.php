<?php

$email = $_POST["email"];

//Primer validamos que cumpla los estructura de un correo
if(filter_var( $email, FILTER_VALIDATE_EMAIL )){
    echo "true";
}else{
    echo "false";
}

?>