<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
$consulta = new Query; 
$opc= $consulta->getLevel();

$Nopc=count($opc);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Grado</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="../Dashboard/js/button2.js"></script>
</head>

<body>
<?php
  require('../Dashboard/Dashboard.php')

?>
          <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="SaveGrade.php" method="POST">
              <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                  <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                    <p id="te"></p>
                        <label for="nivel" class="block text-sm font-medium text-gray-700">Nivel</label>
                        <select id="nivel" name="nivel" autocomplete="nivel" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                          <option value="Selecciona">Selecciona el nivel</option>
                          <?php
                              if ($Nopc>0) {
                                for ($i=0; $i <=$Nopc ; $i++) { 
                                  echo "\t<option value=".$opc[$i]["idnivel"].">".$opc[$i]["nombre"]."</option>";
                                }
                              }else {
                                echo "\t<option value=''>No hay niveles</option>";
                              }
                             
                          ?>
                        </select>
                        <a href="../levels/LevelShow.php" class="text-blue-600">¿Desea añadir más niveles?</a>
                      </div>
                      <div class="col-span-6 sm:col-span-3">
                      <label for="grado" class="block text-sm font-medium text-gray-700">Grado</label>
                      <p id="gra"></p>
                        <input type="text" name="grado" id="grado" class="w-1/4	 p-1.5   lg:w-full  outline-none focus:border-gray-500 border-b-2 focus:border-solid" >
                    </div>
                    <div class="col-span-6">
                      <label for="seccion" class="block text-sm font-medium text-gray-700">Seccion</label>
                      <p id="sec"></p>
                      <input type="text" name="seccion" pattern="[a-zA-Z]{1}"title="Solamente se permiten letras y un Caracter" id="seccion" autocomplete="seccion" class="w-1/4	 p-1.5   lg:w-full  outline-none focus:border-gray-500 border-b-2 focus:border-solid">
                    </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <button type="submit" id="guardar" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Guardar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      
</body>
</html>
<script src="js/GradesComparison.js"></script>