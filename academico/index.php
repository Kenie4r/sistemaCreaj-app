<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Acádemico</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Dashboard/button.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
?>
    <article class="container">
        <div class="m-9">
            <div class="mb-7 lg:m-0">
                <h1 class="text-5xl text-blue-800 text-center">Acádemico</h1>
            </div>
        </div>
        <div class="box-border grid lg:grid-cols-3 gap-2 text-center m-7">
            <a href="../Matter/index.php" class="bg-blue-500 hover:bg-blue-700 text-white rounded-lg p-6">
                <p class="text-5xl mb-2"><span class="icon-books"></span></p>
                <p class="text-2xl">Materias</p>
            </a>
            <a href="../levels/index.php" class="bg-blue-500 hover:bg-blue-700 text-white rounded-lg p-6">
                <p class="text-5xl mb-2"><span class="icon-book"></span></p>
                <p class="text-2xl">Niveles</p>
            </a>
            <a href="../grades/index.php" class="bg-blue-500 hover:bg-blue-700 text-white rounded-lg p-6">
                <p class="text-5xl mb-2"><span class="icon-file-text"></span></p>
                <p class="text-2xl">Grados</p>
            </a>
        </div>
    </article>
</body>
</html>