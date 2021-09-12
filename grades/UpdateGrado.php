<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
$consulta = new Query; 
$id=$_GET['id'];
//agrarr el grado
$grado=$consulta->selectGradobyID($id);
//agarra los niveles
$niveles=$consulta->getLevel();
//valores de grado
$Proyec=$consulta-> getGradeIdInProjects($id);
$asign=$consulta->getGradeIdInAssing($id);
foreach ($grado as $name) {
    $nombre=$name['nombre'];
    $seccion=$name['seccion'];
    $idNiGra=$name['nivel_idnivel'];
    //compara el id de nivel dentro de grado con el id del nivel
    foreach($niveles as $nivel){
        if ($idNiGra==$nivel['idnivel']) {
            $level=$nivel['nombre'];
        }
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Grado</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="../Dashboard/js/button2.js"></script>
</head>

<body>
<?php
  require('../Dashboard/Dashboard.php')

?>
      <?php
        if (isset($_GET['id'])&&$Proyec<1&&$asign<1) {
          ?><div class="mt-5 md:mt-0 md:col-span-2">
            <!---<form action="UpdateGrado.php?id=<?php# echo $id?>" method="POST">--->
            <form action="SaveUpdateGrade.php?id=<?php echo $id?>" method="POST">
              <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                  <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                      <label for="grado" class="block text-sm font-medium text-gray-700">Grado</label>
                      <p id="gra"></p>
                        <input type="text" name="grado" id="grado" value="<?php echo $nombre?>">
                    </div>
      
                    <div class="col-span-6">
                      <label for="seccion" class="block text-sm font-medium text-gray-700">Seccion</label>
                      <p id="sec"></p>
                      <input type="text" pattern="[a-zA-Z]{1}"title="Solamente se permiten letras y un Caracter" value="<?php echo $seccion?>" name="seccion" id="seccion" autocomplete="seccion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="nivel" class="block text-sm font-medium text-gray-700">Nivel</label>
                        <p id="te"></p>
                        <select id="nivel" name="nivel" autocomplete="nivel" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                          <?php
                                echo "\t<option selected value=".$idNiGra.">".$level."</option>";
                                foreach($niveles as $nivel){
                                    echo "\t<option value=".$nivel['idnivel'].">".$nivel['nombre']."</option>";
                                }
                          ?>
                        </select>
                      </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <button type="submit" id="guardar" name="guardar" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Actualizar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php
        }else {
          ?>
          <section class="container">
  <div class="m-4 lg:m-7 bg-red-400 border-2 border-solid border-red-800 rounded-lg">
      <div class="m-4 lg:m-7 text-center">
          <p class="lg:text-4xl text-red-900">Sucedio un error, El grado No se puede actualizar.</p>
      </div>
      <div class="m-4 lg:m-7 flex justify-center">
      <p>No se puede actualizae porque esta relacionado con otro dato. </p> <br>
       <p>Lo contiene: <b><?php echo $Proyec." proyectos , y ".$asign." Asignaciones Relacionadas."?></b> </p>
       <a href='Index.php' class='flex border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700'><span class='icon-circle-left'></span> Regresar</a>
      </div>
  </div>
          <?php 
        }
      
      ?>
          
</body>
</html>
<script src="js/GradesComparison.js"></script>