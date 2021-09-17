<!DOCTYPE html>
<html lang="es">
<head>
    <title>Crea J | Inicio</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--<script src="js/dashboard.js"></script> -->
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="button.js"></script>
    <script src="js/button2.js"></script>
</head>
<body class="bg-">
<?php
        require('Dashboard.php');
        require_once("../controlador/firstTime.php");
        primeraVez();
?>
    <!-- This example requires Tailwind CSS v2.0+ -->
<div class="px-52 mt-20 bg-white shadow overflow-hidden sm:rounded-lg">
  <div class="px-4 py-5 sm:px-6">
    <h3 class="lg:text-xl sm:text-2xl md:text-2xl  leading-6 font-medium text-gray-900">
      Perfil
    </h3>
    <p class="mt-1 lg:ax-w-2xl sm:text-2xl md:text-2xl text-base text-gray-500">
      Informacion personal
    </p>
  </div>
  <div class="border-t border-gray-200">
    <dl>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="lg:text-lg sm:text-2xl md:text-2xl font-medium text-gray-500">
          Nombre
        </dt>
        <dd class="lg:text-lg sm:text-2xl md:text-2xl mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
         <?php echo $_SESSION['nombres'];?> 
        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="lg:text-lg sm:text-2xl md:text-2xl font-medium text-gray-500">
          Apellido
        </dt>
        <dd class="lg:text-lg sm:text-2xl md:text-2xl mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
        <?php echo $_SESSION['apellidos'];?> 
        </dd>
      </div>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="lg:text-lg sm:text-2xl md:text-2xl font-medium text-gray-500">
          Email 
        </dt>
        <dd class="lg:text-lg sm:text-2xl md:text-2xl mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
        <?php echo $_SESSION['email'];?> 
        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="lg:text-lg sm:text-2xl md:text-2xl font-medium text-gray-500">
          Rol
        </dt>
        <dd class="lg:text-lg sm:text-2xl md:text-2xl mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
        <?php
         switch($_SESSION['rol']){
            case 'a':
                echo "Administrador";
            break;
            case 'c':
                echo "Tecnico cientifico" ;
            break;
            case 'i':
              echo "Instructor" ;
              break;
            case 'j':
                echo "Jurado";
            break;
        }
        ?>
        <div class="mt-2 flex -ml-64 flex-row items-center justify-center p-5 w-full">
            <div class="border-2 border-blue-500 text-xl p-2 text-blue-500 hover:bg-blue-400 hover:text-white cursor-pointer" >
               <a href="../profile/editPersonalData.php" > Editar </a>
            </div>
            <div class="border-2 border-blue-500 text-xl ml-2 p-2 text-blue-500 hover:bg-blue-400 hover:text-white cursor-pointer" >
               <a href="../profile/editPassword.php">Cambiar contraseña</a>
            </div>
        </div>
        </dd>
      </div>
    </dl>
  </div>
  <script src="button.js"></script>
  <script src="js/button2.js"></script>
</body>

</html> 
