<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="recursos_login/css/estilologin.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="h-screen" onload="Iniciar()">
        <!-- Formulario -->
        
        <section class="flex md:flex-row h-full justify-center lg:justify-center lg:ml-20">
           <article class="w-96 flex justify-center item-center ml-22 lg:w-2/5 mt-24 flex-col ">
               <h1 class=" text-2xl ml-4 lg:text-2xl">Sistema de calificación</h1>
                    <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded " action="index.php" method="POST" id="formLogin">
                        <div class="mb-4" >
                            <label class="md:text-2xl sm:text-2xl block mb-2 lg:text-sm font-bold text-gray-700"><span>Usuario:</span></label>
                            <input type="text" name="usuario"  class=" px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" maxlength="20" size="30" placeholder="Código" title="Ingresa tu código de usuario para ingresar al sistema" autofocus required>
                        </div>
                        <div>
                            <label class="md:text-2xl sm:text-2xl block mb-2 lg:text-sm font-bold text-gray-700" ><span>Contraseña:</span></label>
                            <div class="text" id="contenedor02">
                                <input type="password" name="contra" class="px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" maxlength="20" size="25" placeholder="Contraseña" title="Ingresa tu contraseña para ingresar al sistema" required>
                                <button type="button" id="cambiarType" class="eye" onclick="cambiar01()"></button>
                            </div>
                        </div>
                        <div class="grupo01" id="btnOC">
                    <?php 
                    //action="Dashboard/Dashboard.php"
                            if(isset($_POST['enviar'])){
                                require('modelo/conection.php');
                                require('modelo/query.php');
                                require('controlador/login.php');
                                $user=filter_input(INPUT_POST,'usuario');
                                $pass=filter_input(INPUT_POST,'contra');
                                $logear = logear($user,$pass);
                                if($logear){
                                    header('Location: Dashboard/profile.php');
                                }else{
                                    print("<div class='bg-red-200 text-red-600 text-center border border-1 border-red-600 p-2 m-2'>
                                            Ha surgido un error, verique que sus datos esten correctos
                                    </div>");
                                }
                            }
                    ?>    
                        </div>
                        <div class="ml-16" id="btnEnviar">
                            <button type="submit" name="enviar" class="mr-20 mt-5 px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline  ">Iniciar</button>
                        </div>
                    </form>

           </article> 
           <article class="ml-10 w-full lg:w-4/5 h-full hidden lg:block" >
                <img class="w-full object-right m-auto w-60 h-full mr-2 -mt-4" src="recursos_login/img/fotoColegio.jpg">
            </article>
        </section>
    <!-- Pie de página -->
        <footer class="text-center lg:-mt-4 py-9 text-white bg-black px-4 py-2 bottom-auto ">Colegio Don Bosco 2021 </footer>
    </div>
</body>
</html>