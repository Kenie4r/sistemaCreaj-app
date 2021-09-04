<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
$consulta = new Query; 
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
<?php
  require('../Dashboard/Dashboard.php')

?>
    <?php
         if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $guardarNom=$consulta->deleteMatter($id);
            echo "se pudo borrar"; echo"<div class='bg-green-400 border-t border-b border-blue-500 text-white px-4 py-3' role='alert'>
            <div class='py-1'><svg class='fill-current h-6 w-6 text-teal-500 mr-4' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path d='M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z'/></svg>
            <p class='font-bold'>Dato Guardado </p></div>
            <p class='text-sm'>Se Borró el dato correctamente</p>
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
                 <p>No se pudo borrar el dato</p> 
               </div>
             </div><?php
            }
    
    ?>
</body>
</html>