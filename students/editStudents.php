<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("soporteStudents.php");

$consulta = new Query; //Crear una consulta

$idestudiante =$_GET["student"];
$estudiantes = $consulta->getEstudiantesById($idestudiante);

$Grado = $consulta->getGrado();
$grado = $consulta->getGradeById($estudiantes);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Nueva rúbrica</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script-newStudents.js"></script>
    <script src="../Dashboard/button.js"></script>
</head>
<body class="bg-">
<?php
require('../Dashboard/Dashboard.php');
?>
    <form id="frmNewRubric" class="container box-content" method="POST" action="updateStudents.php">
        <h1 class="text-center w-3/4 lg:w-full lg:text-5xl outline-none focus:border-gray-500 border-b-2 focus:border-solid mt-8">Editar datos del estudiante</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="flex lg:m-9">
            <div class="lg:m-2">
                    <p id="btnSubmit" class="lg:m-5 md:m-3 sm:m-3 block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700 cursor-pointer"><span class="icon-checkmark"></span> Guardar</p>
                </div>
                <div class="lg:mt-7 md:mt-3 mx-2 lg:m-2">
                    <a href="index.php" class="block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-red-600"><span class='icon-cross'></span> Cancelar</a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 m-8">
            <div>
            <?php
            for ($i=0; $i < count($estudiantes); $i++) { 
                ?>
                <div class=" flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtID" class="p-2 bg-gray-700 text-white">Código</label>
                    <input class="w-1/4	 p-1.5   lg:w-full  outline-none focus:border-gray-500 border-b-2 focus:border-solid" readonly type="text" name="txtCodigo" id="txtNombreRubrica" value="<?php echo $estudiantes[$i]['idestudiante'] ?>" >
                    <label for="txtNombreRubrica" title="Editar" ><span class="icon-pencil"></span></label>
                </div>
            </div>
                <div> 
                    <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                        <label for="txtID" class="p-2 bg-gray-700 text-white">Nombre</label>
                        <input class="w-1/4	  p-1.5  lg:w-full  outline-none focus:border-gray-500 border-b-2 focus:border-solid" type="text" name="txtNombre" id="txtNombreRubrica" value="<?php echo $estudiantes[$i]['nombre'] ?>" >
                        <label for="txtNombreRubrica" title="Editar" ><span class="icon-pencil"></span></label>
                    </div>
                </div>
                <div> 
                    <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                        <label for="txtID" class="p-2 bg-gray-700 text-white">Apellido</label>
                        <input class="w-1/4	 lg:w-full p-1.5 outline-none focus:border-gray-500 border-b-2 focus:border-solid" type="text" name="txtApellido" id="txtNombreRubrica" value="<?php echo $estudiantes[$i]['apellidos'] ?>" >
                        <label for="txtNombreRubrica" title="Editar" ><span class="icon-pencil"></span></label>
                    </div>
                </div>
                <div class="mt-10">  
                    <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                        <label for="txtID" class="p-2 bg-gray-700 text-white">Grado:</label>
                        <select name="txtGrado" id="txtMateria" class="p-1 w-full rounded-r-lg outline-none">
                     <?php
                         if(empty($Grado)){
                            echo "<option value=''>No hay Grados para elegir</option>\n";
                        }else{
                            echo "<option value='" . $estudiantes[$i]['grado_idgrado'] . "'>" . $consulta->getNameGradoEstudiantes($estudiantes[$i]['grado_idgrado'])  . "</option>\n";
                            foreach ($Grado as $key => $gradoNombre) {
                                if($Grado["idgrado"] = $estudiantes[$i]['grado_idgrado']){
                                    echo "<option value='" . $gradoNombre["idgrado"] . "'>" . $gradoNombre["nombre"] . "</option>\n";
                                }
                                
                            }
                        }
                    ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
       </div>

    </form>
</body>
</html>   
        