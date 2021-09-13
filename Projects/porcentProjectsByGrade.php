<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

$consulta = new Query; //Crear una consulta
$Proyecto = $consulta->getProject(); //Get Estudiantes

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Crea J | Proyectos por grado</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--<script src="js/dashboard.js"></script> -->
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="../js/script-Projects.js"></script>
    <script src="../Dashboard/button.js"></script>
    <script src="../Dashboard/js/button2.js"></script>
</head>
<body class="">
<?php
    require('../Dashboard/Dashboard.php');

    if(isset($_GET['grado'])){
        $idgrado = $_GET['grado'];
        $grado = $consulta->getGradeById2($idgrado);
        if(empty($grado)){
            $estadoGrado = false;
        }else{
            $estadoGrado = true;
        }
    }else{
        $estadoGrado = false;
    }
?>
      <section class="container">
<?php
if( $estadoGrado ){
    $proyectosGenerales = $consulta->getProjectsByGrade($idgrado);
    $proyectosGeneralesCalificados = $consulta->getCountRatedPbyGrade($idgrado);
    $cantidadProyectosG = count($proyectosGenerales);
    $cantidadProyectosGC = count($proyectosGeneralesCalificados);
    $porcentajeGeneralesPorcentaje = round( ( $cantidadProyectosGC / $cantidadProyectosG ) * 100 );

    $materias = $consulta->getSubjectByGradeP($idgrado);
?>
        <div class="m-9">
            <div class="mb-7 lg:m-0">
                <h1 class="text-5xl text-gray-900 text-center">Proyectos de <?php echo $grado[0]['nombre']; ?></h1>
            </div>
        </div>
        <div class="m-6 flex lg:justify-center">
            <div class="mx-2 lg:m-2">
                <a href="../ranking/index.php" class="block text-blue-600 border-blue-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-blue-600"><span class='icon-circle-left'></span> Regresar</a>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-9 m-9">
<?php
foreach ($materias as $key => $idmateria) {
    $materia = $consulta->getMatterById($idmateria['materia_idmateria']);
    $proyectosMateria = $consulta->getProjectByGradeAndMatter($idgrado, $idmateria['materia_idmateria']);
    $cantidadProyectosM = count($proyectosMateria);
    $proyectosMateriaCalificados = $consulta->getCountRatedPbyGradeAndMatter($idgrado, $idmateria['materia_idmateria']);
    $cantidadProyectosMC = count($proyectosMateriaCalificados);
    $porcentajeMateria = round( ( $cantidadProyectosMC / $cantidadProyectosM ) * 100 );
?>
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="mb-4">
                    <h2 class="text-3xl text-gray-500 text-center"><?php echo $materia['nombre']; ?></h2>
                </div>
                <div class="mb-4">
                    <p class="text-center text-gray-500"><?php echo $cantidadProyectosMC; ?> proyectos calificados de <?php echo $cantidadProyectosM; ?></p>
                </div>
                <div class="mb-4">
                    <div class="h-4 bg-red-500 rounded-lg" style="width: <?php echo $porcentajeMateria; ?>%;"></div>
                </div>
            </div>
<?php
}
?>
        </div>
        <div class="m-9">
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="mb-4">
                    <h2 class="text-3xl text-gray-500 text-center">Proyectos en total</h2>
                </div>
                <div class="mb-4">
                    <p class="text-center text-gray-500"><?php echo $cantidadProyectosGC; ?> proyectos calificados de <?php echo $cantidadProyectosG; ?></p>
                </div>
                <div class="mb-4">
                    <div class="h-4 bg-blue-500 rounded-lg" style="width: <?php echo $porcentajeGeneralesPorcentaje; ?>%;"></div>
                </div>
            </div>
        </div>
<?php
}else{
?> 
        <div class="m-9">
            <div class="mb-7 lg:m-0">
                <h1 class="text-5xl text-gray-900 text-center">Proyectos calificados</h1>
            </div>
        </div>
        <div class="m-6 flex lg:justify-center">
            <div class="mx-2 lg:m-2">
                <a href="../ranking/index.php" class="block text-blue-600 border-blue-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-blue-600"><span class='icon-circle-left'></span> Regresar</a>
            </div>
        </div>
        <div class="m-9">
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="mb-4">
                    <h2 class="text-3xl text-gray-500 text-center">No hay proyectos calificados...</h2>
                </div>
            </div>
        </div>
<?php
}
?>
    </section>
</body>
</html> 