<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("../controlador/infoNivelesAprobacion.php");

$consulta = new Query; //Crear una consulta
$materias = $consulta->getMatter(); //Get materias
$grados = $consulta->getGrade(); //Get grados

//ID
$idrubrica = $_GET["idrubric"];

$rubrica = $consulta->getRubricById($idrubrica);
$materia_rubrica = $consulta->getMatterById($rubrica["materia_idmateria"]);
$grado_rubrica = $consulta->getGradeById2($rubrica["grado_idgrado"]);

$criterios = $consulta->getCriteriosByIdRubric($idrubrica);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Editar rúbrica</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script-editRubric.js"></script>
    <script src="../js/script-frmRubricValidate.js"></script>
    <script src="../Dashboard/button.js"></script>
    <script src="../Dashboard/js/button2.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
?>
    <form id="frmRubric" class="container box-content" method="POST" action="updateRubric.php">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="flex flex-col m-9">
                <div class="flex flex-row items-center text-gray-500 text-3xl">
                    <div id="ctNR" class="flex flex-row items-center content-center border-b-2 border-solid border-green-700">
                        <input class="w-3/4 lg:w-full lg:text-5xl outline-none" type="text" name="txtNombreRubrica" id="txtNombreRubrica" value="<?php echo $rubrica["nombre"]; ?>" maxlength="45" required>
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
                    <input type="text" name="txtID" id="txtID" value="
<?php

echo $idrubrica;

?>
                    " class="p-1 w-full rounded-r-lg outline-none" maxlength="15" readonly>
                </div>
            </div>
            <div>
                <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtMateria" class="p-2 bg-gray-700 text-white">Materia</label>
                    <select name="txtMateria" id="txtMateria" class="p-1 w-full rounded-r-lg outline-none">
<?php

echo "<option value='" . $materia_rubrica["idmateria"] . "'>" . $materia_rubrica["nombre"] . "</option>\n";
foreach ($materias as $key => $materia) {
    if($materia["idmateria"] != $materia_rubrica["idmateria"]){
        echo "<option value='" . $materia["idmateria"] . "'>" . $materia["nombre"] . "</option>\n";
    }
}

?>
                    </select>
                </div>
            </div>
            <div>
                <div class="flex flex-row items-center w-full lg:w-4/5 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtNivel" class="p-2 bg-gray-700 text-white">Grado</label>
                    <select name="txtNivel" id="txtNivel" class="p-1 w-full rounded-r-lg outline-none">
<?php

$nombreGradoRubrica = $grado_rubrica[0]["nombre"] . " " . $grado_rubrica[0]["seccion"];

echo "<option value='" . $grado_rubrica[0]["idgrado"] . "'>" . $nombreGradoRubrica . "</option>\n";
foreach ($grados as $key => $grado) {
    if($grado["idgrado"] != $grado_rubrica[0]["idgrado"]){
        echo "<option value='" . $grado["idgrado"] . "'>" . $grado["nombre"] . " " . $grado["seccion"] . "</option>\n";
    }
}

?>
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
                    <!-- C R I T E R I O S   P H P -->
<?php

for ($i=0; $i < count($criterios); $i++) { 
    $niveles_criterios = $consulta->getLevelsByIdCriterio($criterios[$i]["idcriterios"]);

?>
                    <div id='<?php echo $i; ?>-criterio' class='bg-white rounded-lg shadow-lg container'>
                        <!-- D A T O S -->
                        <input type='hidden' id='<?php echo $i; ?>-idcriterio' name='<?php echo $i; ?>-idcriterio' value='<?php echo $criterios[$i]["idcriterios"]; ?>'>
                        <div class='grid grid-cols-3 m-4'>
                            <div class='w-full'>
                                <input type='text' name='<?php echo $i; ?>-txtNombreCriterio' id='<?php echo $i; ?>-txtNombreCriterio' value='<?php echo $criterios[$i]["titulo"]; ?>' class='w-4/5 outline-none focus:border-gray-800 border-b-2 focus:border-solid'>
                                <label for='<?php echo $i; ?>-txtNombreCriterio' title='Editar' class="w-1/5"><span class="icon-pencil"></span></label>
                            </div>
                            <div class='w-full'>
                                <label for='<?php echo $i; ?>-nbPuntaje' class='w-2/5'>Porcentaje:</label>
                                <input type='number' name='<?php echo $i; ?>-nbPuntaje' id='<?php echo $i; ?>-nbPuntaje' min='0' max='100' value='<?php echo $criterios[$i]["puntaje"]; ?>' class='w-2/5 outline-none focus:border-gray-800 border-b-2 focus:border-solid'>
                                <label for='<?php echo $i; ?>-nbPuntaje' title='Editar' class='w-1/5'><span class="icon-pencil"></span></label>
                            </div>
                            <div class='flex justify-end'>
<?php
if($i == 0){
?>
                                <p id='<?php echo $i; ?>-btnDelete' title='El formulario no se puede quedar sin ningún criterio' class='rounded-full w-8 h-8 flex items-center justify-center text-red-900 border-red-900 border-solid border-2'></p>
<?php
}else{
?>
                                <p id='<?php echo $i; ?>-btnDelete' title='Eliminar el criterio' class='rounded-full w-8 h-8 flex items-center justify-center text-red-900 border-red-900 border-solid border-2 cursor-pointer'><span class='icon-cross'></span></p>
                                <?php
}
?>
                            </div>
                        </div>
                        <!-- N I V E L E S -->
                        <div id='<?php echo $i; ?>-nivelesAprobacion' class=''>
                            <!-- N I V E L    1 -->
                            <div id='<?php echo $i; ?>-0-nivelAprobacion' class=''>
                                <input type='hidden' id='<?php echo $i; ?>-0-idnivel' name='<?php echo $i; ?>-0-idnivel' value='<?php echo $niveles_criterios[0]["idnaprobacion"]; ?>'>
                                <div class='grid grid-cols-3 m-4 border-red-900 border-2 border-solid rounded-lg'>
                                    <div class='flex justify-center items-center border-r-2 border-solid border-red-900'>
                                        <p class='text-red-900 font-bold'><?php echo $rangosNivelesAprobacion[0]; ?></p>
                                    </div>
                                    <textarea name='<?php echo $i; ?>-0-descripcionNivel' id='<?php echo $i; ?>-0-descripcionNivel' cols='50' rows='3' class='col-span-2 bg-red-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-red-400 placeholder-black' placeholder='[ Agregar descripción... ]'><?php echo $niveles_criterios[0]["descripcion"]; ?></textarea>
                                </div>
                            </div>
                            <!-- N I V E L    2 -->
                            <div id='<?php echo $i; ?>-1-nivelAprobacion' class=''>
                            <input type='hidden' id='<?php echo $i; ?>-1-idnivel' name='<?php echo $i; ?>-1-idnivel' value='<?php echo $niveles_criterios[1]["idnaprobacion"]; ?>'>
                                <div class='grid grid-cols-3 m-4 border-yellow-900 border-2 border-solid rounded-lg'>
                                    <div class='flex justify-center items-center border-r-2 border-solid border-yellow-900'>
                                        <p class='text-yellow-900 font-bold'><?php echo $rangosNivelesAprobacion[1]; ?></p>
                                    </div>
                                    <textarea name='<?php echo $i; ?>-1-descripcionNivel' id='<?php echo $i; ?>-1-descripcionNivel' cols='50' rows='3' class='col-span-2 bg-yellow-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-yellow-400 placeholder-black' placeholder='[ Agregar descripción... ]'><?php echo $niveles_criterios[1]["descripcion"]; ?></textarea>
                                </div>
                            </div>
                            <!-- N I V E L    3 -->
                            <div id='<?php echo $i; ?>-2-nivelAprobacion' class=''>
                                <input type='hidden' id='<?php echo $i; ?>-2-idnivel' name='<?php echo $i; ?>-2-idnivel' value='<?php echo $niveles_criterios[2]["idnaprobacion"]; ?>'>
                                <div class='grid grid-cols-3 m-4 border-blue-900 border-2 border-solid rounded-lg'>
                                    <div class='flex justify-center items-center border-r-2 border-solid border-blue-900'>
                                        <p class='text-blue-900 font-bold'><?php echo $rangosNivelesAprobacion[2]; ?></p>
                                    </div>
                                    <textarea name='<?php echo $i; ?>-2-descripcionNivel' id='<?php echo $i; ?>-2-descripcionNivel' cols='50' rows='3' class='col-span-2 bg-blue-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-blue-400 placeholder-black' placeholder='[ Agregar descripción... ]'><?php echo $niveles_criterios[2]["descripcion"]; ?></textarea>
                                </div>
                            </div>
                            <!-- N I V E L    4 -->
                            <div id='<?php echo $i; ?>-3-nivelAprobacion' class=''>
                                <input type='hidden' id='<?php echo $i; ?>-3-idnivel' name='<?php echo $i; ?>-3-idnivel' value='<?php echo $niveles_criterios[3]["idnaprobacion"]; ?>'>
                                <div class='grid grid-cols-3 m-4 border-green-900 border-2 border-solid rounded-lg'>
                                    <div class='flex justify-center items-center border-r-2 border-solid border-green-900'>
                                        <p class='text-green-900 font-bold'><?php echo $rangosNivelesAprobacion[3]; ?></p>
                                    </div>
                                    <textarea name='<?php echo $i; ?>-3-descripcionNivel' id='<?php echo $i; ?>-3-descripcionNivel' cols='50' rows='3' class='col-span-2 bg-green-500 rounded-r-lg p-4 w-full bg-transparent outline-none focus:bg-green-400 placeholder-black' placeholder='[ Agregar descripción... ]'><?php echo $niveles_criterios[3]["descripcion"]; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
}
?>
                    <!-- Criterios n -->
                    <input type="hidden" name="nCriterios" id="nCriterios" value="<?php echo count($criterios); ?>">
                    <input type="hidden" name="siguienteCriterio" id="siguienteCriterio" value="<?php echo count($criterios); ?>">
                </div>
                <div class="p-4 flex justify-center">
                    <p id="addCriterio" class="text-blue-600 border-blue-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-blue-600 cursor-pointer"><span class="icon-plus"></span> Agregar criterios</p>
                </div>
            </div>
        </div>
    </form>
    <!-- LOADING... -->
    <article id="sending" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
			<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
				<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <!-- Contenedor alerta -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="flex flex-col">
                        <div class="flex items-center justify-center pt-6 px-6">
                            <div>
                                <p class="text-2xl leading-6 font-medium text-yellow-900">Actualizando Rubrica...</p>
                            </div>
                        </div>
                        <div class="p-6 text-center text-4xl text-yellow-900">
                            <p id="spinnerSending" class="animate-spin mr-3"><span class="icon-spinner2"></span></p>
                        </div>
                    </div>
				</div>
			</div>
		</article>
</body>
</html>