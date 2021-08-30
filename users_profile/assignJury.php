<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("../controlador/soporteAsignacionProyectosJurados.php");

$consulta = new Query; //Consulta
$idUser = $_GET["iduser"]; //El id del usuario

$asignacionesUsuario = $consulta->getProjectsinfo($idUser); //Obtenemos las asignaciones de este jurado

$usuario = $consulta->getUserById($idUser); //Obtenemos los datos de este jurado
$nombreCompleto = $usuario["nombres"] . " " . $usuario["apellidos"]; //Formamos el nombre de este jurado

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
//Verificamos si ya tiene asignaciones previas
if(empty($asignacionesUsuario)){
    //Si no tiene, creamos un ítem por defecto
?>
                <div id="0-item-asignacion" class="lg:flex lg:flex-row p-4 mb-2 bg-gray-400 rounded-lg">
                    <input type="hidden" name="0-id-item-asignacion" id="0-id-item-asignacion" value="">   
                    <div class="grid grid-cols-1 lg:grid-cols-2 lg:w-5/6">
                        <div>
                            <div class="flex flex-row items-center w-full  mb-7 lg:m-0">
                                <label for="0-sltMateria" class="p-2">Materia:</label>
                                <select name="0-sltMateria" id="0-sltMateria" maxlength="50" class="p-1 w-full border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none"required>
                                    <?php writeMatter($asignacionesUsuario[$i]["materia_idmateria"]); ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="flex flex-row items-center  w-full mb-7 lg:m-0">
                                <label for="0-sltGrade" class="p-2">Grado:</label>
                                <select name="0-sltGrade" id="0-sltGrade" maxlength="50" class="p-1 w-full border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none" required>
                                    <?php writeGrade($asignacionesUsuario[$i]["grado_idgrado"]); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class='flex justify-end lg:w-1/6'>
                        <p id='0-btnDelete' title='El formulario no se puede quedar sin ninuna asignación' class='rounded-full w-8 h-8 flex items-center justify-center text-red-900 border-red-900 border-solid border-2 cursor-pointer'></p>
                    </div>
                </div>
                <input type="hidden" name="cantidadAsignaciones" id="cantidadAsignaciones" value="1">
<?php
}else{
    //Si tiene, escribimos un ítem por cada asignación
    for ($i = 0; $i < count($asignacionesUsuario); $i++) {     
?>
                <div id="<?php echo $i; ?>-item-asignacion" class="lg:flex lg:flex-row p-4 mb-2 bg-gray-400 rounded-lg">
                    <input type="hidden" name="<?php echo $i; ?>-id-item-asignacion" id="<?php echo $i; ?>-id-item-asignacion" value="<?php echo $asignacionesUsuario[$i]["idasignacionJ"]; ?>">   
                    <div class="grid grid-cols-1 lg:grid-cols-2 lg:w-5/6">
                        <div>
                            <div class="flex flex-row items-center w-full  mb-7 lg:m-0">
                                <label for="<?php echo $i; ?>-sltMateria" class="p-2">Materia:</label>
                                <select name="<?php echo $i; ?>-sltMateria" id="<?php echo $i; ?>-sltMateria" maxlength="50" class="p-1 w-full border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none"required>
                                    <?php writeMatter($asignacionesUsuario[$i]["materia_idmateria"]); ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="flex flex-row items-center  w-full mb-7 lg:m-0">
                                <label for="<?php echo $i; ?>-sltGrade" class="p-2">Grado:</label>
                                <select name="<?php echo $i; ?>-sltGrade" id="<?php echo $i; ?>-sltGrade" maxlength="50" class="p-1 w-full border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none" required>
                                    <?php writeGrade($asignacionesUsuario[$i]["grado_idgrado"]); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class='flex justify-end lg:w-1/6'>
<?php
        //Si es el ítem 0, por defecto, no se podrá eliminar; pero si es del 1 en adelante, sí se podra
        if($i == 0){
?>
                        <p id='<?php echo $i; ?>-btnDelete' title='El formulario no se puede quedar sin ninuna asignación' class='rounded-full w-8 h-8 flex items-center justify-center text-red-900 border-red-900 border-solid border-2 cursor-pointer'></p>
<?php                    
        }else{
?>
                        <p id='<?php echo $i; ?>-btnDelete' title='Eliminar asignación' class='rounded-full w-8 h-8 flex items-center justify-center text-red-900 border-red-900 border-solid border-2 cursor-pointer'><span class='icon-cross'></span></p>
<?php
        }
?>
                    </div>
                </div>
<?php
    }
?>
                <input type="hidden" name="cantidadAsignaciones" id="cantidadAsignaciones" value="<?php echo count($asignacionesUsuario); ?>">
<?php
}
?>
            </div>
            <div id="item-agregar" class="flex justify-center m-8 cursor-pointer">
                <div class="">
                    <p id="btnAgregar" class="block text-blue-700 border-blue-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-blue-700"><span class="icon-plus"></span> Agregar asignación</p>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="lg:m-2">
                    <p id="btnSubmit" class="block text-green-700 border-green-700 border-2 border-solid rounded-lg cursor-pointer p-2 hover:text-white hover:bg-green-700"><span class="icon-checkmark"></span> Guardar</p>
                </div>
                <div class="mb-2 lg:m-2">
                    <a href="index.php" class="block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-red-600"><span class='icon-cross'></span> Cancelar</a>
                </div>
            </div>
        </form>
    </section>
</body>
</html>