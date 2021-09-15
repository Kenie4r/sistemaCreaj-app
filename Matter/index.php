<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
$consulta=new Query;
$materias=$consulta->getMatter();
$nMat=count($materias);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias</title>
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
    <script src="../Dashboard/js/button2.js"></script>
</head>
<body>
<?php
  require('../Dashboard/Dashboard.php')

?>
          <div class="mt-5 md:mt-0 md:col-span-2">
            <div>
            <form action="SaveMatter.php" method="POST">
              <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                  <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                    <div class="col-span-6">
                      <label for="materia" class="block text-sm font-medium text-gray-700">Ingresar una nueva materia</label>
                      <input type="text" name="materia" id="materia" autocomplete="mat" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                      </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <button type="submit" id="guardar" name="guardar"class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Guardar
                  </button>
                </div>
              </div>
            </form> 
            <p id="test"></p>
            <p id="te"></p>
            </div>
            <div>
            <div class="md:px-32 py-8 w-full">
  <div class="shadow overflow-hidden rounded border-b border-gray-200">
    <table class="min-w-full bg-white">
      <thead class="bg-gray-800 text-white">
        <tr>
          <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Materias</th>
          <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm"></th>
          <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm"></th>
        </tr>
      </thead>
    <tbody class="text-gray-700">
      <?php
      for ($i=0; $i <$nMat; $i++) { 
        echo "<tr>";
        echo "\t<td class='w-1/3 text-left py-3 px-4'>" . $materias[$i]["nombre"] . "</td>";
        echo"<td> <a href='DeleteMatter.php?id=".$materias[$i]["idmateria"]."'>Eliminar</a>  </td>";
        echo"<td> <a href='UpdateMatter.php?id=".$materias[$i]["idmateria"]."'>Editar</a>  </td>";
        echo "</tr>";
      }
        
      ?>

    </tbody>
    </table>
  </div>
</div>
            </div>
          </div>
         
</body>
</html>