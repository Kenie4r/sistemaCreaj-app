<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("../controlador/infoNivelesAprobacion.php");
require_once("../controlador/soporteRubricasNuevas.php");

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
    <script src="../js/script-newRubric.js"></script>
    <script src="../js/script-frmRubricValidate.js"></script>
    <script src="../Dashboard/button.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
require_once("../parameters/soporteParametros.php");
comparacionFecha("Ingreso de rubricas");
?>
    <form id="frmRubric" class="container box-content" method="POST" action="saveRubric.php">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="flex flex-col m-9">
                <div class="flex flex-row items-center text-gray-500 text-3xl">
                    <div id="ctNR" class="flex flex-row items-center content-center border-b-2 border-solid border-green-700">
                        <input class="w-3/4 lg:w-full lg:text-5xl outline-none" type="text" name="txtNombreRubrica" id="txtNombreRubrica" value="Nueva Rúbrica" maxlength="45" required>
                        <label for="ckbNameValidate"><span id="lbEstadoNR" class="icon-checkmark text-green-700"></span></label>
                    </div>
                    <label for="txtNombreRubrica" title="Editar" ><span class="icon-pencil"></span></label>
                    <input type="checkbox" name="ckbNameValidate" id="ckbNameValidate" class="hidden" disabled>
                </div>
                <div>
                    <p class="text-green-700" id="lbMensajeNR">Nombre válido</p>
                </div>
            </div>
            <div class="flex lg:justify-end ml-9 lg:m-9">
                <div class="lg:m-2">
                    <a href="#" id="btnSubmit" class="block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700"><span class="icon-checkmark"></span> Guardar</a>
                </div>
                <div class="mx-2 lg:m-2">
                    <a href="index.php" class="block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-red-600"><span class='icon-cross'></span> Cancelar</a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 m-9">
            <div>
                <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtID" class="p-2 bg-gray-700 text-white">ID</label>
                    <input type="text" name="txtID" id="txtID" value="<?php echo newIDRubric(); ?>" maxlength="15" class="p-1 w-full rounded-r-lg outline-none" readonly>
                </div>
            </div>
            <div>
                <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtMateria" class="p-2 bg-gray-700 text-white">Materia</label>
                    <select name="txtMateria" id="txtMateria" class="p-1 w-full rounded-r-lg outline-none">
<?php writeMatterForNewRubric(); ?>
                    </select>
                </div>
            </div>
            <div>
                <div class="flex flex-row items-center w-full lg:w-4/5 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtNivel" class="p-2 bg-gray-700 text-white">Nivel</label>
                    <select name="txtNivel" id="txtNivel" class="p-1 w-full rounded-r-lg outline-none">
<?php writeLevelForNewRubric(); ?>
                    </select>
                </div>
            </div>
        </div>
        <!-- C A J A    C R I T E R I O S -->
        <div class="m-9">
            <!-- E N C A B E Z A D O -->
            <div class="grid grid-cols-1 lg:grid-cols-2 p-4 bg-gray-700 rounded-t-lg text-white text-3xl">
                <div>
                    <h2 class="">Criterios</h2>
                </div>
                <div class="flex flex-row justify-end">
                    <input type="number" name="puntajeTotal" id="puntajeTotal" min="0" max="100" class="bg-gray-700 outline-none text-right" title="Este número representa la calificación actual de la rúbrica, siendo el máximo 100 pues se usa un sistema base 100 y no 10" value="1" readonly>
                    <p> / 100</p>
                </div>
            </div>
            <!-- C U E R P O -->
            <div class="bg-gray-300 rounded-b-lg">
                <!-- C R I T E R I O S -->
                <div id="contenedor-criterios" class="grid grid-cols-1 lg:grid-cols-2 gap-4 p-4">
                    <!-- C R I T E R I O   1 -->
                    <div id='0-criterio' class='bg-gray-500 rounded-lg shadow-lg container'>
                        <!-- D A T O S -->
                        <div class='grid grid-cols-3 m-4'>
                            <div class='w-full'>
                                <input type='text' name='0-txtNombreCriterio' id='0-txtNombreCriterio' value='Criterio 0' maxlength='45' class='w-4/5 bg-gray-500 outline-none focus:border-gray-800 border-b-2 focus:border-solid'>
                                <label for='0-txtNombreCriterio' title='Editar' class="w-1/5"><span class="icon-pencil"></span></label>
                            </div>
                            <div class='w-full'>
                                <label for='0-nbPuntaje' class='w-2/5'>Porcentaje:</label>
                                <input type='number' name='0-nbPuntaje' id='0-nbPuntaje' min='0' max='100' value='1' class='w-2/5 bg-gray-500 outline-none focus:border-gray-800 border-b-2 focus:border-solid'>
                                <label for='0-nbPuntaje' title='Editar' class='w-1/5'><span class="icon-pencil"></span></label>
                            </div>
                            <div class='flex justify-end'>
                                <p id='0-btnDelete' title='El formulario no se puede quedar sin ningún criterio' class='rounded-full w-8 h-8 flex items-center justify-center text-red-900 border-red-900 border-solid border-2'></p>
                            </div>
                        </div>
                        <!-- N I V E L E S -->
                        <div id='0-nivelesAprobacion' class=''>
                            <!-- N I V E L    1 -->
                            <div id='0-0-nivelAprobacion' class=''>
                                <div class='grid grid-cols-3 m-4 border-red-900 border-2 border-solid rounded-lg'>
                                    <div class='flex justify-center items-center border-r-2 border-solid border-red-900'>
                                        <p class='text-red-900 font-bold'><?php echo $rangosNivelesAprobacion[0]; ?></p>
                                    </div>
                                    <textarea name='0-0-descripcionNivel' id='0-0-descripcionNivel' cols='50' rows='3' class='col-span-2 bg-red-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-red-400 placeholder-black' placeholder='[ Agregar descripción... ]'></textarea>
                                </div>
                            </div>
                            <!-- N I V E L    2 -->
                            <div id='0-1-nivelAprobacion' class=''>
                                <div class='grid grid-cols-3 m-4 border-yellow-900 border-2 border-solid rounded-lg'>
                                    <div class='flex justify-center items-center border-r-2 border-solid border-yellow-900'>
                                        <p class='text-yellow-900 font-bold'><?php echo $rangosNivelesAprobacion[1]; ?></p>
                                    </div>
                                    <textarea name='0-1-descripcionNivel' id='0-1-descripcionNivel' cols='50' rows='3' class='col-span-2 bg-yellow-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-yellow-400 placeholder-black' placeholder='[ Agregar descripción... ]'></textarea>
                                </div>
                            </div>
                            <!-- N I V E L    3 -->
                            <div id='0-2-nivelAprobacion' class=''>
                                <div class='grid grid-cols-3 m-4 border-blue-900 border-2 border-solid rounded-lg'>
                                    <div class='flex justify-center items-center border-r-2 border-solid border-blue-900'>
                                        <p class='text-blue-900 font-bold'><?php echo $rangosNivelesAprobacion[2]; ?></p>
                                    </div>
                                    <textarea name='0-2-descripcionNivel' id='0-2-descripcionNivel' cols='50' rows='3' class='col-span-2 bg-blue-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-blue-400 placeholder-black' placeholder='[ Agregar descripción... ]'></textarea>
                                </div>
                            </div>
                            <!-- N I V E L    4 -->
                            <div id='0-3-nivelAprobacion' class=''>
                                <div class='grid grid-cols-3 m-4 border-green-900 border-2 border-solid rounded-lg'>
                                    <div class='flex justify-center items-center border-r-2 border-solid border-green-900'>
                                        <p class='text-green-900 font-bold'><?php echo $rangosNivelesAprobacion[3]; ?></p>
                                    </div>
                                    <textarea name='0-3-descripcionNivel' id='0-3-descripcionNivel' cols='50' rows='3' class='col-span-2 bg-green-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-green-400 placeholder-black' placeholder='[ Agregar descripción... ]'></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Criterios n -->
                    <input type="hidden" name="nCriterios" id="nCriterios" value="1">
                    <input type="hidden" name="siguienteCriterio" id="siguienteCriterio" value="1">
                </div>
                <div class="p-4 flex justify-center">
                    <p id="addCriterio" class="text-blue-600 border-blue-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-blue-600 cursor-pointer"><span class="icon-plus"></span> Agregar criterios</p>
                </div>
            </div>
        </div>
    </form>
</body>
</html>