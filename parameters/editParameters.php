<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
$idparametros = $_GET["idparam"];
$consulta = new Query; //Crear una consulta
$parametros = $consulta->getParametrosById($idparametros);
$FechaInico =$consulta->getFechaInicio($idparametros);
$FechaFin =$consulta->getFechaFin($idparametros);
//print_r("\t<td class='p-6'>" . $FechaInico. "</td>");
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
 <form id="frmRubric" class="container box-content" method="POST" action="updateParameters.php?idparam= <?php echo $idparametros; ?>">
    <h1 class="lg:justify-center text-center lg:w-3/4 lg:w-full lg:text-5xl md:text-2xl sm:text-2xl outline-none focus:border-gray-500 border-b-2 focus:border-solid mt-8">Modificar parámetro</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 ml-24">
            <div class="flex lg:m-9">
                <div class="lg:m-2">
                <a href="" id="btnSubmit" class=" lg:m-5 md:m-3 sm:m-3 block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700"><span class="icon-checkmark"></span><input type="submit" value="Guardar"> </a>
                </div>
                <div class="mx-2 lg:m-2">
                    <a href="index.php" class="lg:m-5 md:m-3 sm:m-3 block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-red-600"><span class='icon-cross'></span> Cancelar</a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 m-9 content-center lg:justify-center ">
                <div class=""> 
                    <div class="flex flex-row items-center w-full lg:w-4/5 h-full lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                        <label for="txtinicio" class="p-2 bg-gray-700 text-white">Fecha de inicio</label>
                        <input class="p-1.5 w-full  rounded-r-lg outline-none" type="date" name="txtFechaInicio" value="<?php echo $FechaInico;?>" >
                    </div>
               </div>
                <div class=""> 
                    <div class="flex flex-row items-center w-full lg:w-4/5 h-full lg:m-0 border-gray-700 border-solid border-2 rounded-lg ">
                        <label for="txtfin" class="p-2 bg-gray-700 text-white">Fecha de cierre</label>
                        <input class="p-1.5 w-full rounded-r-lg outline-none" type="date" name="txtFechaFin" value="<?php echo $FechaFin;?>" >
                   </div>
               </div>
        </div>
    </form>
</body>
</html>
             
