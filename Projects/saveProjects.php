<?php
    require_once("../modelo/conection.php");
    require_once("../modelo/query.php");
    
//Verificar session

$consulta = new Query; //Crear una consulta

//Guardar Proyecto

$name= $_POST["txtNombre"];
$existente= $consulta->existenteProyecto($name);
$descripcion= $_POST["txtDescripcion"];
$idGrado= $_POST["txtGrado"];
$idMateria= $_POST["txtMateria"];


$hayrepetidos = false;
$Datoprojects= $consulta->saveProjects($name, $descripcion, $idGrado, $idMateria);
$idProyecto=$consulta->getIdprojectsByNombre();
if(isset($_POST["txtAlumnos"])){
    echo "no se ve";
$id_estudiante= $_POST["txtAlumnos"];
foreach($id_estudiante as $valor){
    $id_estudiante =$valor;
    $existenteEstudiante=$consulta->existenteAlumnoProyecto($id_estudiante);
    if($existenteEstudiante != ""){
        $hayrepetidos = true;
        break;
    }
}

print_r ($id_estudiante);
if(!($hayrepetidos)){
    foreach($id_estudiante as $valor){
        $id_estudiante =$valor;
        $proyecto= $idProyecto;
        $Datosteam= $consulta->saveTeam($id_estudiante, $proyecto);
    }
}



}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Guardar Proyectos</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Dashboard/button.js"></script>
    <script src="../Dashboard/js/button2.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');

if($Datoprojects == "Registro hecho" && $name !="" && $descripcion != "" && $idGrado != "" && $idMateria != "" && isset($_POST["txtAlumnos"]) ){
    if($existente == $name){
        ?>
        <section class="container">
        <div class="m-4 lg:m-7 bg-red-400 border-2 border-solid border-red-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-red-900">Sucedio un error, el nombre del Proyecto ya existe.</p>
            </div>
            <div class="m-4 lg:m-7 flex justify-center">
                <a href="newProjects.php" class="text-red-700 border-red-700 border-2 border-solid rounded-lg p-2 hover:text-red-400 hover:bg-red-700 cursor-pointer"><span class="icon-circle-left"></span> Regresar</a>
            </div>
        </div>
    </section>
    <?php
    }elseif($hayrepetidos){
        ?>
        <section class="container">
        <div class="m-4 lg:m-7 bg-red-400 border-2 border-solid border-red-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-red-900">Sucedio un error, al menos un estudiante ya estaba asignado.</p>
            </div>
            <div class="m-4 lg:m-7 flex justify-center">
                <a href="newProjects.php" class="text-red-700 border-red-700 border-2 border-solid rounded-lg p-2 hover:text-red-400 hover:bg-red-700 cursor-pointer"><span class="icon-circle-left"></span> Regresar</a>
            </div>
        </div>
    </section>
    <?php
    }else{
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
    }
}else{
    ?>
    <section class="container">
        <div class="m-4 lg:m-7 bg-red-400 border-2 border-solid border-red-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-red-900">Sucedio un error, el Proyecto no se ha guardado correctamente.</p>
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