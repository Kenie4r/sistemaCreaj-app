<?php

class Query{

    //Obtener todos los usuarios existentes
    public function getUsers(){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM usuario";
        $sentencia = $conexion->prepare($sql);
        if(!$sentencia){
            return "Error";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }

    //Obtener todos el usuario activo
    public function getUserActivo($nombre, $pass){
        
        $modelo = new Conection;
        $conexion = $modelo->_getConection();
        $sql = "SELECT * FROM usuario WHERE usario = :nombre AND password = :pass";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":pass", $pass);
        if(!$sentencia){
            return "";
        }else{
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            
            return $resultado;
        }
    }
    
}

?>