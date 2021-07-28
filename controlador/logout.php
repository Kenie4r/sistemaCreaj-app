<?php

require('../modelo/conection.php');
session_start();
$session_uid = '';
$_SESSION['uid'] = '';
session_destroy($_SESSION['uid']);
session_destroy($_SESSION['rol']);
if(empty($session_uid) && empty($_SESSION['uid'])){
    $url = BASE_URL . "index.php";
    header("Location: http://creaj21/ " );
}
    
?>