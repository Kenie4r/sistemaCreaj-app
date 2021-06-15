<?php
    function logear( $user, $pass ){
        $consulta = new Consultas_U();
        $usuario = $consulta->getUserActivo($user,$pass);
        if( count($usuario) > 0 ){
            session_start();
            $_SESSION['uid'] = $user;
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

?>