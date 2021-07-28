<?php
    function logear( $user, $pass){
        $consulta = new Query();
        $usuario = $consulta->getUserActivo($user,$pass);
        
        print_r ($usuario['rol']);
        if( count($usuario) > 0 ){
            session_start();
            $_SESSION['uid'] = $user;
            $_SESSION['rol'] = $usuario['rol'];
            header('Location: http://');
            return true;
        }else{
            header('Location: http://');
            return false;
        }
    }
    function entrar(){
        session_start();
        if( !empty($_SESSION['uid']) ){
            return $_SESSION['uid'];
        }else{
            header("Location: http://");
        }
    }
    function cerrar(){
        session_destroy($_SESSION['uid']);
        header("Location: http://");
    }

   



    //función de generar HTML

    function createHTMLHead($tittle){
        $html = <<< 'EOD'
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        
        </head>
        <body 

        EOD;
        echo($html);
    }

?>