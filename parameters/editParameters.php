<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
$parametros = $consulta->getParametrosById($idparametros);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Nuevo parametro</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script-newRubric.js"></script>
    <script src="../Dashboard/button.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
?>
 <form id="frmRubric" class="container box-content" method="POST" action="saveparameter.php">
    <h1 class="text-center w-3/4 lg:w-full lg:text-5xl outline-none focus:border-gray-500 border-b-2 focus:border-solid mt-8">Agregar parámetro</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 ml-24">
            <div class="flex lg:m-9">
                <div class="lg:m-2">
                <a href="" id="btnSubmit" class=" block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700"><span class="icon-checkmark"></span><input type="submit" value="Guardar"> </a>
                </div>
                <div class="mx-2 lg:m-2">
                    <a href="index.php" class="block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-red-600"><span class='icon-cross'></span> Cancelar</a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 m-9 ml-36">
           <div class="flex flex-row items-center lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                <label for="txtID" class="p-2 bg-gray-700 text-white">ID</label>
                <input type="number" class="w-1/4  lg:w-full p-1.5 outline-none focus:border-gray-500 border-b-2 focus:border-solid" type="text" name="txtID"  value="" >
                <label for="txtNombreRubrica" title="Editar" ><span class="icon-pencil"></span></label>
            </div>
            <div>
                <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtMateria" class="p-2 bg-gray-700 text-white">Parámetro</label>
                    <select name="txtParametros" id="txtMateria" class="p-1 w-full rounded-r-lg outline-none">

                        <option value="value1"selected>Elige un parámetro</option>
                        <option value="Estudiantes">Estudiantes</option>
                        <option value="Proyectos">Proyectos</option>
                        <option value="Rúbricas">Rúbricas</option>
                        <option value="Calificar">Calificar</option>
                        <option value="Usuarios">Usuarios</option>
                    </select>
                </div>
            </div>
                <div class=" "> 
                <?php
                for ($i=0; $i < count($parametros); $i++) { 
                    $inicio = $consulta->getParametrosById($parametros[$i]["idparametros"]);

                ?>
                    <div class="flex flex-row items-center w-full lg:w-4/5 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                        <label for='<?php echo $i; ?>-txtinicio' class="w-60 p-2 bg-gray-700 text-white">Fecha de inicio</label>
                        <input class="p-1 w-full rounded-r-lg outline-none" type="date" name='<?php echo $i; ?>-txtFechaInicio' value="" >
                    </div>
               </div>
                <div class="mt-10"> 
                    <div class="flex flex-row items-center w-full lg:w-4/5 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                        <label for='<?php echo $i; ?>-txtfin' class="w-60 p-2 bg-gray-700 text-white">Fecha de cierre</label>
                        <input class="p-1 w-full rounded-r-lg outline-none" type="date" name='<?php echo $i; ?>-txtFechaFin' value="" >
                   </div>
               </div>
        </div>
    </form>
</body>
</html>
             
