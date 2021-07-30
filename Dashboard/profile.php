<!DOCTYPE html>
<html lang="es">
<head>
    <title></title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--<script src="js/dashboard.js"></script> -->
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="button.js"></script>
</head>
<body >
    <?php
         require('Dashboard.php');
    ?>
    <section class="text-center bg-gray-300 mt-8 ml-80 mr-80">
    <h1 class=" text-2xl ml-4 ">Perfil</h1>
        <article class="p-4 ">
        <img class="h-3/6 w-5/12 " src="img/paisaje.jpeg" alt="">
        <img class="h-32 w-40 -mt-14  rounded-full " src="img/perfil.jpg" alt="">

        </article>
        <article>
            <h1>Detalles</h1><br>
            <h1 class="text-center">  <?php echo $_SESSION['nombres'] ?> </h1>

            <h1 class="text-center"><?php echo $_SESSION['apellidos'];  ?> </h1>
           
            <h1>Email:  <?php echo $_SESSION['email']; ?></h1>
        
            <h1>Usuario: <?php echo $_SESSION['usario'] ?></h1>

            <h1>password:   <?php  echo $_SESSION['password']; ?></h1>
          
        </article>
    </section>
</body>
</html> 
