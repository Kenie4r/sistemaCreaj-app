<?php

require('../modelo/conection.php');
session_start();
$session_uid = '';
$_SESSION['uid'] = '';
session_destroy();
if(empty($session_uid) && empty($_SESSION['uid'])){
    header("Location: http://creaj21/sistemaCreaj-app/index.php" );
}
    
?>