<?php

class Conection{

    public function _getConection(){

        $user = "admin";
        $pass = "123456";
        $host = "localhost";
        $db = "mydb";

        $conectar = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
        
        return $conectar;
    }
}

?>