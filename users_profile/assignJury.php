<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("../controlador/soporteAsignacionProyectosJurados.php");

$consulta = new Query; //Consulta
$idUser = $_GET["iduser"]; //El id del usuario
$usuario = $consulta->getUserById($idUser);
$asignacionesUsuario = $consulta->getProjectsinfo($idUser);

$nombreCompleto = $usuario["nombres"] . " " . $usuario["apellidos"];;

//Terminar y que se guarden
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Asignación proyectos</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script-newAssignJury.js"></script>
    <script src="../js/script-frmAsignacionValidate.js"></script>
    <script src="../Dashboard/button.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
?>
    <section class="p-8">
        <form action="saveAssignJury.php" method="POST" class="w-full bg-gray-800 p-4 rounded-lg shadow-lg" name="frmAsignacion" id="frmAsignacion">
            <div class="flex flex-col justify-center items-center lg:m-9">
                <h1 class="text-5xl text-gray-500">Asignación de proyectos</h1>
                <h1 class="text-3xl text-gray-500"><?php echo $nombreCompleto; ?></h1>
            </div>
            <input type="hidden" name="usuario" id="usuario" value="<?php echo $idUser; ?>">
            <div id="contenedor-asignacion" class="bg-white rounded-lg m-7 p-2">
<?php
if(empty($asignacionesUsuario)){
?>
                <div id="0-item-asignacion" class="grid grid-cols-1 lg:grid-cols-2 p-4 mb-2 bg-gray-400 rounded-lg">
                    <div>
                        <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0">
                            <label for="0-sltMateria" class="p-2">Materia:</label>
                            <select name="0-sltMateria" id="0-sltMateria" maxlength="50" class="p-1 w-full border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none"required>
                                <?php writeMatter(); ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0">
                            <label for="0-sltGrade" class="p-2">Grado:</label>
                            <select name="0-sltGrade" id="0-sltGrade" maxlength="50" class="p-1 w-full border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none" required>
                                <?php writeGrade(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="cantidadAsignaciones" id="cantidadAsignaciones" value="1">
<?php
}else{
    for ($i = 0; $i < count($asignacionesUsuario); $i++) {     
?>
                <div id="<?php echo $i; ?>-item-asignacion" class="grid grid-cols-1 lg:grid-cols-2 p-4 bg-gray-400 rounded-lg">
                    <div>
                        <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0">
                            <label for="<?php echo $i; ?>-sltMateria" class="p-2">Materia:</label>
                            <select name="0-sltMateria" id="0-sltMateria" maxlength="50" class="p-1 w-full border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none"required>
                                <?php writeMatter(); ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0">
                            <label for="0-sltGrade" class="p-2">Grado:</label>
                            <select name="0-sltGrade" id="0-sltGrade" maxlength="50" class="p-1 w-full border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none" required>
                                <?php writeGrade(); ?>
                            </select>
                        </div>
                    </div>
                </div>
<?php
    }
?>
                <input type="hidden" name="cantidadAsignaciones" id="cantidadAsignaciones" value="<?php echo count($asignacionesUsuario); ?>">
<?php
}
?>
                <div id="item-agregar" class="flex justify-center">
                    <div class="lg:m-2">
                        <p id="btnAgregar" class="block text-blue-700 border-blue-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-blue-700"><span class="icon-plus"></span> Agregar asignación</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="lg:m-2">
                    <a href="#" id="btnSubmit" class="block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700"><span class="icon-checkmark"></span> Guardar</a>
                </div>
                <div class="mb-2 lg:m-2">
                    <a href="index.php" class="block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-red-600"><span class='icon-cross'></span> Cancelar</a>
                </div>
            </div>
        </form>
    </section>
</body>
</html>