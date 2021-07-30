<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
$consulta = new Query; 
$grado= $consulta->getGrado();
$opc= $consulta->getLevel();
$Ngra=count($grado);
?>
<body>

    <div class="rounded-md mt-8 mx-2 border-blue-900">
        <div class="bg-blue-500 rounded-md h-4/5">  
            <h1 class="font-sans mt-2 mx-2 p-3 text-white text-xl">Niveles y Grados</h1>
        </div>   
        <div class="bg-green-400 w-20 mx-2 mt-2 text-white p-1">
            <span class="icon-plus"> <a href="NewGrade.php" class="font-sans">Nuevo</a></span>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Grado
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Sección
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Nivel
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Acciones
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <?php
                        for ($i=0; $i <$Ngra ; $i++) { 
                          echo "<tr>";
                          echo "\t<td class='p-4'>" . $grado[$i]["nombre"] . "</td>";
                          echo "\t<td class='p-4'>" . $grado[$i]["seccion"] . "</td>";
                          switch ($grado[$i]["nivel_idnivel"]) {
                            case '1':
                              echo "\t<td class='p-4'>Bachillerato</td>";
                              break;
                            
                            default:
                            echo "\t<td class='p-4'>Tristeza</td>";
                              break;
                          

                          }
                          echo"<td> <a href='DeleteGrado.php?id=".$grado[$i]["idgrado"]."'>Eliminar</a>  </td>";
                          echo"<td> <a href='UpdateGrado.php?id=".$grado[$i]["idgrado"]."'>Eliminar</a>  </td>";
                          echo "</tr>";
                        }
                      
                      ?>
          
                      <!-- More people... -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
</body>
</html>