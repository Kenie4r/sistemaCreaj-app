<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="recursos_login/css/estilologin.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body onload="Iniciar()">
    <div>
        <img class=" ml-auto -mb-32 hidden lg:block w-2/3 h-auto rounded-l-lg" src="recursos_login/img/fotoColegio.jpg">
    </div>
    
	    <!-- Formulario -->
        <section class="-mt-96 ml-20 ">
            <h1 class="pt-2 text-2xl ">Sistema de calificación</h1>
            <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded" action="index.php" method="POST" id="formLogin">
                <div class="mb-4" >
                    <label class="block mb-2 text-sm font-bold text-gray-700"><span>Usuario:</span></label>
                    <input type="text" name="usuario"  class=" px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" maxlength="20" size="30" placeholder="Código" title="Ingresa tu código de usuario para ingresar al sistema" autofocus required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-700" ><span>Contraseña:</span></label>
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
			            logear($user,$pass);
			        }
			?>    
                    <a href="contrasenaOlvidada.php" class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800">He olvidado mi contraseña...</a>
                </div>
                
				<div class="" id="btnEnviar">
                    <button type="submit" name="enviar" class="w-medium px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-">Iniciar</button>
                </div>

                
            </form>
            
        </section>
    <!-- Pie de página -->
        <footer class="text-center mt-20 p-11 text-white bg-black px-4 py-2 bottom-auto">- Copyright Colegio Don Bosco 2020 -</footer>
    </div>
</body>
</html>
