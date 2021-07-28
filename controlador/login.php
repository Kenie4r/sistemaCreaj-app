<?php
    function logear( $user, $pass){
        $consulta = new Query();
        $usuario = $consulta->getUserActivo($user,$pass);
        echo "<script>alert('".$usuario['rol']."')</script>";
        print_r ($usuario['rol']);
        if( count($usuario) > 0 ){
            session_start();
            $_SESSION['uid'] = $user;
            echo "<script>alert('".$_SESSION['rol']."')</script>";
            print_r ($usuario);
            $_SESSION['rol'] = $usuario['rol'];
            
            //header('Location: http://');
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
        session_destroy($_SESSION['rol']);
        header("Location: http//creaj21");
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