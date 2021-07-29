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
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../recursos/icons/style.css">
</head>
<body>
          <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="SaveGrade.php" method="POST">
              <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                  <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                      <label for="grado" class="block text-sm font-medium text-gray-700">Grado</label>
                      <select id="grado" name="grado" autocomplete="grado" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Selecciona un grado</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                      </select>
                    </div>
      
                    <div class="col-span-6">
                      <label for="seccion" class="block text-sm font-medium text-gray-700">Seccion</label>
                      <input type="text" name="seccion" id="seccion" autocomplete="seccion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="nivel" class="block text-sm font-medium text-gray-700">Nivel</label>
                        <select id="nivel" name="nivel" autocomplete="nivel" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                          <?php
                              for ($i=0; $i <=$Nopc ; $i++) { 
                                echo "\t<option value=".$opc[$i]["idnivel"].">".$opc[$i]["nombre"]."</option>";
                              }
                          ?>
                        </select>
                      </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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