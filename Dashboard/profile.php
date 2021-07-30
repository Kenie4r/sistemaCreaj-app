<!DOCTYPE html>
<html lang="es">
<head>
    <title></title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--<script src="js/dashboard.js"></script> -->
    <link rel="stylesheet" href="../recursos/icons/style.css">
</head>
<body >
    <?php
         require('Dashboard.php');
    ?>
    <section class=" ml-20 mr-96">
    <h1 class=" text-2xl ml-4 ">Perfil</h1>
        <article class="p-4 ">
        <img class="h-32 w-40 rounded-full " src="img/perfil.jpg" alt="">

        </article>
        <article>
            <h1>Nombre completo</h1>
            <?php
            echo $_SESSION['nombres'];
            ?>
            <h1>Email</h1>

            <h1>Usuario</h1>

            <h1>password</h1>
        </article>
    </section>
</body>
</html> 
