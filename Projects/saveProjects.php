<?php
    require_once("../modelo/conection.php");
    require_once("../modelo/query.php");
    
//Verificar session

$consulta = new Query; //Crear una consulta

//Guardar Proyecto

$name= $_POST["txtNombre"];
$descripcion= $_POST["txtDescripcion"];
$idGrado= $_POST["txtGrado"];
$idMateria= $_POST["txtMateria"];
$Datoprojects= $consulta->saveProjects($name, $descripcion, $idGrado, $idMateria);
$idProyecto=$consulta->getIdprojectsByNombre($name);
$id_estudiante= $_POST["txtAlumnos"];
$i=0;
$e=0;
foreach($id_estudiante as $valor){
    $id_estudiante =$valor;
    $i++;
}
do {
    $proyecto= $idProyecto;
    $Datosteam= $consulta->saveTeam($id_estudiante, $proyecto);
    $e++;
} while ($e < $i);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Guardar estudiante</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Dashboard/button.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
if($Datoprojects == "Registro hecho"){
?>
    <section class="container">
        <div class="m-4 lg:m-7 bg-green-500 border-2 border-solid border-green-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-green-900">se ha guardado con éxito los datos del proyecto.</p>
            </div>
            <div class="m-4 lg:m-7 flex justify-center">
                <a href="index.php" class="text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-green-500 hover:bg-green-700 cursor-pointer"><span class="icon-circle-left"></span> Regresar</a>
            </div>
        </div>
    </section>
<?php
}else{
?>
    <section class="container">
        <div class="m-4 lg:m-7 bg-red-400 border-2 border-solid border-red-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-red-900">Sucedio un error, el estudiante no se ha guardado correctamente.</p>
            </div>
            <div class="m-4 lg:m-7 flex justify-center">
                <a href="index.php" class="text-red-700 border-red-700 border-2 border-solid rounded-lg p-2 hover:text-red-400 hover:bg-red-700 cursor-pointer"><span class="icon-circle-left"></span> Regresar</a>
            </div>
        </div>
    </section>
    <?php
}
?>
</body>
</html>