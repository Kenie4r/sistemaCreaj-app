<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

//Verificar session

$consulta = new Query; //Crear una consulta
$materias = $consulta->getMatter(); //Get materias
$niveles = $consulta->getLevel(); //Get niveles

//ID
$idrubrica = $_GET["idrubric"];

$rubrica = $consulta->getRubricById($idrubrica);
$materia_rubrica = $consulta->getMatterById($rubrica["materia_idmateria"]);
$nivel_rubrica = $consulta->getLevelById($rubrica["nivel_idnivel"]);

$criterios = $consulta->getCriteriosByIdRubric($idrubrica);

$sumaCriterios = 0;

for ($i=0; $i < count($criterios); $i++) { 
    $sumaCriterios += $criterios[$i]["puntaje"];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Rúbrica</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Dashboard/button.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
?>
    <section class="container box-content">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="m-9 text-gray-500 text-3xl">
                <h1 class="w-3/4 lg:w-full lg:text-5xl"><?php echo $rubrica["nombre"]; ?></h1>
            </div>
            <div class="flex lg:justify-end ml-9 lg:m-9">
                <div class="mx-2 lg:m-2">
                    <a href="editRubric.php?idrubric=<?php echo $rubrica["idrubrica"]; ?>" class="block text-green-600 border-green-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-600"><span class='icon-pencil'></span> Editar</a>
                </div>
                <div class="mx-2 lg:m-2">
                    <a href="index.php" class="block text-blue-600 border-blue-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-blue-600"><span class='icon-circle-left'></span> Regresar</a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 m-9">
            <div>
                <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                    <p class="p-2 bg-gray-700 text-white">ID</p>
                    <p class="p-1 w-full rounded-r-lg"><?php echo $rubrica["idrubrica"]; ?></p>
                </div>
            </div>
            <div>
                <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                    <p class="p-2 bg-gray-700 text-white">Materia</p>
                    <p class="p-1 w-full rounded-r-lg"><?php echo $materia_rubrica["nombre"]; ?></p>
                </div>
            </div>
            <div>
                <div class="flex flex-row items-center w-full lg:w-4/5 border-gray-700 border-solid border-2 rounded-lg">
                    <p class="p-2 bg-gray-700 text-white">Nivel</p>
                    <p class="p-1 w-full rounded-r-lg outline-none"><?php echo $nivel_rubrica["nombre"]; ?></p>
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
                <div class="flex justify-end">
                    <p class="bg-gray-700 outline-none text-right"><?php echo $sumaCriterios; ?> / 100</p>
                </div>
            </div>
            <!-- C U E R P O -->
            <div class="bg-gray-300 rounded-b-lg">
                <!-- C R I T E R I O S -->
                <div id="contenedor-criterios" class="grid grid-cols-1 lg:grid-cols-2 gap-4 p-4">
                    <!-- C R I T E R I O S   P H P -->
<?php

for ($i=0; $i < count($criterios); $i++) { 
    $niveles_criterios = $consulta->getLevelsByIdCriterio($criterios[$i]["idcriterios"]);

?>
                    <div id='<?php echo $i; ?>-criterio' class='bg-gray-500 rounded-lg shadow-lg container'>
                        <!-- D A T O S -->
                        <div class='grid grid-cols-2 m-4'>
                            <div class='w-full'>
                                <p class='w-4/5 bg-gray-500 font-bold text-xl'><?php echo $criterios[$i]["titulo"]; ?></p>
                            </div>
                            <div class='w-full flex justify-end'>
                                <p class='bg-gray-500'><?php echo $criterios[$i]["puntaje"]; ?> Puntos</p>
                            </div>
                        </div>
                        <!-- N I V E L E S -->
                        <div id='<?php echo $i; ?>-nivelesAprobacion' class=''>
                            <!-- N I V E L    1 -->
                            <div id='<?php echo $i; ?>-1-nivelAprobacion' class=''>
                                <div class='grid grid-cols-3 m-4 border-red-900 border-2 border-solid rounded-lg'>
                                    <div class='flex justify-center items-center border-r-2 border-solid border-red-900'>
                                        <p class='text-red-900 font-bold'>Inicial receptivo</p>
                                    </div>
                                    <p class='col-span-2 bg-red-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-red-400 placeholder-black'><?php echo $niveles_criterios[0]["descripcion"]; ?></p>
                                </div>
                            </div>
                            <!-- N I V E L    2 -->
                            <div id='<?php echo $i; ?>-2-nivelAprobacion' class=''>
                                <div class='grid grid-cols-3 m-4 border-yellow-900 border-2 border-solid rounded-lg'>
                                    <div class='flex justify-center items-center border-r-2 border-solid border-yellow-900'>
                                        <p class='text-yellow-900 font-bold'>Básico</p>
                                    </div>
                                    <p class='col-span-2 bg-yellow-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-yellow-400 placeholder-black' readonly><?php echo $niveles_criterios[1]["descripcion"]; ?></p>
                                </div>
                            </div>
                            <!-- N I V E L    3 -->
                            <div id='<?php echo $i; ?>-3-nivelAprobacion' class=''>
                                <div class='grid grid-cols-3 m-4 border-blue-900 border-2 border-solid rounded-lg'>
                                    <div class='flex justify-center items-center border-r-2 border-solid border-blue-900'>
                                        <p class='text-blue-900 font-bold'>Autónomo</p>
                                    </div>
                                    <p class='col-span-2 bg-blue-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-blue-400 placeholder-black' readonly><?php echo $niveles_criterios[2]["descripcion"]; ?></p>
                                </div>
                            </div>
                            <!-- N I V E L    4 -->
                            <div id='<?php echo $i; ?>-4-nivelAprobacion' class=''>
                                <div class='grid grid-cols-3 m-4 border-green-900 border-2 border-solid rounded-lg'>
                                    <div class='flex justify-center items-center border-r-2 border-solid border-green-900'>
                                        <p class='text-green-900 font-bold'>Estratégico</p>
                                    </div>
                                    <p class='col-span-2 bg-green-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-green-400 placeholder-black' readonly><?php echo $niveles_criterios[3]["descripcion"]; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
}
?>
                </div>
            </div>
        </div>
    </section>
</body>
</html>