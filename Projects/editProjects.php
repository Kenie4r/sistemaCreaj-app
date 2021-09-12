<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("soporteProject.php");

$consulta = new Query; //Crear una consulta
$idproyecto = $_GET["idproject"];
$projects = $consulta->getProjectById($idproyecto);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Ver Proyecto</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script-newProjects.js"></script>
    <script src="../Dashboard/button.js"></script>
    <script src="../Dashboard/js/button2.js"></script>
    <script src="StudentsGrade.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
require_once("../parameters/soporteParametros.php");
comparacionFecha("Ingreso de proyectos");
?>
 <form id="frmProject" class="container box-content" method="POST" action="updateProjects.php">
        <div class="grid grid-cols-1 lg:grid-cols-2 ">
             <?php
            for ($i=0; $i < count($projects); $i++) { 
            ?>
            <div class="flex flex-col m-9">
                <div class="flex flex-row items-center text-gray-500 text-3xl">
                    <div id="ctNR" class="flex flex-row items-center content-center border-b-2 border-solid border-green-700">
                        <input class="w-3/4 lg:w-full lg:text-5xl outline-none" type="text" name="txtNombre" readonly value="<?php echo $projects[$i]['nombreProyecto'] ?>" maxlength="45" required>
                    </div>
               
                </div>
            </div>
            <div class="flex lg:justify-end ml-9 lg:m-9">
                <div class="mx-2 lg:m-2">
                    <a href="evaluacionProyecto.php?proyecto=<?php echo $projects[$i]['idproyecto']; ?>" target="_blank" class="block text-yellow-700 border-yellow-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-yellow-700 cursor-pointer"><span class='icon-file-pdf'></span> Evaluación</a>
                </div>
                <div class="mx-2 lg:m-2">
                    <a href="index.php" class="block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700 cursor-pointer"><span class='icon-checkmark'></span> Regresar</a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 m-8 ">

            <div class="lg:mt-10 lg:ml-9">
                <div class="flex flex-row items-center w-full lg:w-full border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtMateria" class="md:h-full p-2 bg-gray-700 text-white">Materia</label>
                    <p class="lg:w-full lg:h-full p-1.5 outline-none focus:border-gray-500 border-b-2 focus:border-solid" type="text" name="txtDescripcion" value="" ><?php echo $consulta->getNameMateria($projects[$i]['materia_idmateria']); ?> </p>
                </div>
            </div>
            <div class="lg:mt-10 lg:ml-9 sm:mt-10">
                <div class="flex flex-row items-center w-full lg:w-full border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtNivel" class="p-2 bg-gray-700 text-white">Grado</label>
                    <p class=" lg:w-full p-1.5 outline-none focus:border-gray-500 border-b-2 focus:border-solid" type="text" name="txtDescripcion" value="" ><?php echo $consulta->getNameGrado($projects[$i]['grado_idgrado']); ?> </p>
                </div>
            </div>
            <div class="lg:mt-20  lg:ml-9 sm:ml-0 sm:-mt-1"> 
                    <div class="my-9 flex flex-row items-center lg:w-full lg:h-full border-gray-700 border-solid border-2 rounded-lg">
                        <label for="txtID" class=" lg:h-full p-10 items-center p-2 bg-gray-700 text-white">Descripcion</label>
                        <p class="lg:justify-center md:w-full p-1.5 outline-none focus:border-gray-700 border-b-2 focus:border-solid" type="text" name="txtDescripcion" value="" ><?php echo $projects[$i]['descripcion'] ?></p>
                    </div>
            </div>       
            <div class="lg:mt-20 lg:ml-9 sm:-mt-10">
                <div class="my-9 flex flex-row items-center lg:w-full lg:h-full sm:h-full border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtNivel" class="p-10 items-center p-2 bg-gray-700 text-white lg:h-full sm:h-full ">Alumnos</label>
                    <?php 
                      $proyecto_idproyecto= $_GET['idproject'];
                      $estudiante = $consulta->getNameApellidos($proyecto_idproyecto); 
                      echo "<p>";
                      for($j=0; $j < count($estudiante); $j++){
                          
                          echo  $estudiante[$j]["nombre"] ." ". $estudiante[$j]["apellidos"]."<br>";
                          
                      }
                      echo "</p>";
                    ?>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </form>
    
</body>
</html>
             