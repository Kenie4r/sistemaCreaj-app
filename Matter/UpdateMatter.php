<?php
    require_once("../modelo/conection.php");
    require_once("../modelo/query.php");
    $consulta = new Query; 
    $id=$_GET['id'];
    $materias=$consulta->getMatterById($id);
    $nombre=$materias['nombre'];
    $Proyec=$consulta->getMatterIdInProyectos($id);
    $Rubri=$consulta->getMatterIdInRubrics($id);
    
    $asign=$consulta->getMatterIdInAssign($id);
    #Guardar lo editado
if (isset($_POST['guardar'])) {
    
    
    if (!empty($_POST['materia'])) {
        $inName=ucfirst($_POST['materia']) ;
        $guardarGrado=$consulta->updateMateria($id, $inName);
        echo"<div class='bg-green-400 border-t border-b border-blue-500 text-white px-4 py-3' role='alert'>
        <div class='py-1'><svg class='fill-current h-6 w-6 text-teal-500 mr-4' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path d='M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z'/></svg>
        <p class='font-bold'>Dato Guardado </p></div>
        <p class='text-sm'>Se guardó el dato correctamente</p>
        <div class='m-4 lg:m-7 flex justify-center'>
                <a href='Index.php' class='text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-green-500 hover:bg-green-700 cursor-pointer'><span class='icon-circle-left'></span> Regresar</a>
            </div>
      </div>";
    }else {
      ?>
      <div role="alert">
        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
          Error
        </div>
        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
          <p>Tipo de dato incorrecto: LLene el campo</p> 
        </div>
      </div>
      <?php
    }
    //$inSeccion=$_POST['seccion'];
    //$inLevel=$_POST['nivel'];*/
    //$update=$consulta->updateGrado($id, $inName, $inSeccion, $inLevel);

    
}else {
    
}
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
    <script>
      $(document).ready(function() {
        $("input").keyup(function() {
          var name=$("input").val();
          $.post("TestMatter.php",{
            nombre:name
          },function (datos,estado) {
            $("#test").html(datos)
          })
        })
      });
    </script>
</head>
<body>
<?php
  require('../Dashboard/Dashboard.php')

?>

<?php 
if (isset($_GET['id'])&&$Proyec<1&&$Rubri<1&&$asign<1) { 
  ?>
  <form action="UpdateMatter.php?id=<?php echo $id?>" method="post">
        <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                  <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                    <div class="col-span-6">
                      <label for="materia" class="block text-sm font-medium text-gray-700">Actualizar materia</label>
                      <input type="text" value="<?php echo $nombre?>" name="materia" id="materia" autocomplete="mat" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                      </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <button type="submit" id="guardar" name="guardar"class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Actualizar
                  </button>
                </div>
              </div>
            </form>
            <p id="test"></p>
            <p id="te"></p>
            </div>
    </form> <?php
}else {
  ?>
             <div role="alert">
               <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                 Error
               </div>
               <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
               <p>No se puede Actualizar porque esta relacionado con otro dato</p> 
             <p>Lo contiene: <b><?php echo $Proyec." proyectos , ".$Rubri." Rubricas,y ".$asign." Asignaciones Relacionadas."?></b> </p>
                 <div class='m-4 lg:m-7 flex justify-center'>
                <a href='Index.php' class='border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700'><span class='icon-circle-left'></span> Regresar</a>
            </div>
               </div>
             </div><?php
}

?>
    
</body>
</html>