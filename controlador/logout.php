<?php

require('../modelo/conection.php');
session_start();
$session_uid = '';
$_SESSION['uid'] = '';
session_destroy();
if(empty($session_uid) && empty($_SESSION['uid'])){
    header("Location: ../index.php" );
}
    
?>