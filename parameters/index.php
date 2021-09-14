<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");

$consulta = new Query; //Crear una consulta
$parametros = $consulta->getParametros(); //Get Estudiantes

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Crea J | Parámetros</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--<script src="js/dashboard.js"></script> -->
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="../js/script-validateActualPassword.js"></script>
    <script src="../js/script-validateRestartDB.js"></script>
    <script src="../Dashboard/button.js"></script>
</head>
<body >
    <?php
         require('../Dashboard/Dashboard.php');
         require_once("../modelo/conection.php");
         require_once("../modelo/query.php");
         
    ?>
      <article class="container">
      <input type="hidden" name="username" id="username" value="<?php echo $_SESSION["usario"]; ?>">
        <div class="grid grid-cols-1 lg:grid-cols-2 m-9">
            <div class="mb-7 lg:m-0">
                <h1 class="text-5xl text-gray-500">Parametros</h1>
            </div>
        </div>

        <div class="box-border m-7 mt-20">
            <table class="w-full border-collapse text-center">
                <thead class="bg-gray-900 text-white">
                    <tr>
                        <td class="rounded-tl-lg p-4">ID</td>
                        <td class="p-4">Nombre</td>
                        <td class="p-4">Fecha de inicio</td>
                        <td class="p-4">Fecha de cierre</td>
                        <td colspan="3" class="rounded-tr-lg p-4">Opciones</td>
                    </tr>
                </thead>
                <tbody id="table-body-rubrica" class="bg-gray-200">
                <?php

if(!empty($parametros)){
    for ($i=0; $i < count($parametros); $i++) { 
        echo "<tr class='lol'>";
        echo "\t<td class='p-6'>" . $parametros[$i]["idparametros"] . "</td>";
        echo "\t<td class='p-6'>" . $parametros[$i]["nombre"] . "</td>";
        echo "\t<td class='p-6'>" . $parametros[$i]["paramFecha"] . "</td>";
        echo "\t<td class='p-6'>" . $parametros[$i]["paramFechaF"] . "</td>";
        echo "\t<td class='p-4'><a href='editParameters.php?idparam=" . $parametros[$i]["idparametros"] . "' class='hover:text-blue-900'><span class='icon-pencil'></span> Editar</a></td>";
        echo "</tr>";
    }
    if($_SESSION['usario'] == "Admin"){
?>
                    <tr>
                        <td class="p-6"><?php echo $i + 1; ?></td>
                        <td class="p-6">Reiniciar base de datos</td>
                        <td colspan='3' class="p-6"><p id="deleteDB-1" class="hover:text-red-900 cursor-pointer"><span class='icon-bin2'></span> Ejecutar parámetro</p></td>
                    </tr>
<?php
    }
}else{
    echo "<tr class='lol'>";
    echo "\t<td colspan='5' class='p-4'><span class='icon-blocked'></span> No hay parámetros en el sistema<td>";
    echo "</tr>";
}

?>
                </tbody>
                <tfoot class="bg-gray-900">
                    <tr>
                        <td colspan="6" class="rounded-b-lg p-2"> </td>
                    </tr>
                </tfoot>
                </table>
        </div>
    </article>
    <div id="confirmRDB" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
			<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
				<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <!-- Contenedor alerta -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="flex flex-col">
                        <div class="flex flex-row items-center gap-4 pt-6 px-6">
                            <div>
                                <p class="rounded-full bg-yellow-900 w-8 h-8 flex items-center justify-center text-yellow-300"><span class="icon-warning"></span></p>
                            </div>
                            <div>
                                <p class="text-2xl leading-6 font-medium text-yellow-900">¿SEGURO DE REINICIAR LA BASE DE DATOS?</p>
                            </div>
                        </div>
                        <div class="p-6 text-justify">
                            <p class="">Ejecutar este parámetro reiniciará la base de 
                                datos a su estado por defecto, eliminando a su paso 
                                todos los datos de:</p>
                            <ol class="list-disc ml-6">
                                <li>Usuarios</li>
                                <li>Rubrica</li>
                                <li>Proyectos</li>
                                <li>Estudiantes</li>
                                <li>Materias</li>
                                <li>Niveles</li>
                                <li>Grados</li>
                                <li>Notas asociadas</li>
                            </ol>
                            <p>Sin ningún medio de recuperación.</p>
                        </div>
                        <div class="px-2 flex items-center justify-center">
                            <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                                <label for="txtActualPassProfile" class="p-2 text-white bg-gray-700 w-full">Confirmar Contraseña:</label>
                                <div class="p-1 w-full rounded-r-lg outline-none bg-white h-full">
                                    <input type="password" name="txtActualPassProfile" id="txtActualPassProfile" class=" w-4/5 outline-none">
                                    <input type="checkbox" name="ckActualPass" id="ckActualPass" class="hidden" disabled>
                                    <label for="ckActualPass"><span id="lbActualPass" class="icon-cross text-red-500 w-1/5"></span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-6 flex justify-center items-center gap-6">
                        <p id="deleteDB-2" class="block text-blue-600 border-blue-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-blue-600 cursor-pointer"><span class='icon-checkmark'></span> CONFIRMAR</p>
                        <a href="index.php" class="block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-red-600"><span class='icon-cross'></span> CANCELAR</a>
                    </div>
				</div>
			</div>
		</div>
        
</body>
</html> 