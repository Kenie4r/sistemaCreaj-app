<?php

require_once("modelo/conection.php");
require_once("modelo/query.php");

$consulta = new Query;

$usuarios = $consulta->getUsers();

?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Inicio</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<?php

echo count($usuarios);


$bool = $consulta->updateUser(2, "tecnico.cientifico", "Miembro", "Salesiano", "t", "hola");

if($bool){
    echo "Modificación realizada";
}

?>
</body>
</html>