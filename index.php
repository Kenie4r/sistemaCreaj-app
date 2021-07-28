<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
</head>
<body onload="Iniciar()">
	    <!-- Formulario -->
        <section id="cajaLogin">
            <h1 id="titulo01">Sistema de calificación<br>Inició de Sesión</h1>
            <form action="Dashboard/Dashboard.php" method="POST" id="formLogin">
                <div class="grupo01" id="txtNombre">
                    <label for="text01"><span>Usuario:</span></label>
                    <input type="text" name="usuario" id="text01" class="text" maxlength="20" size="30" placeholder="Código" title="Ingresa tu código de usuario para ingresar al sistema" autofocus required>
                </div>
                <div class="grupo01" id="txtPass">
                    <label for="text02"><span>Contraseña:</span></label>
                    <div class="text" id="contenedor02">
                        <input type="password" name="contra" id="text02" maxlength="20" size="25" placeholder="Contraseña" title="Ingresa tu contraseña para ingresar al sistema" required>
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
                    <a href="contrasenaOlvidada.php" class="enlace01">He olvidado mi contraseña...</a>
                </div>
                
				<div class="grupo01" id="btnEnviar">
                    <button type="submit" name="enviar" class="btn01">Iniciar</button>
                </div>

                <div class="grupo01" id="btnAyuda">
                    <a href="ayuda.html" class="btn01">Ayuda</a>
                </div>
            </form>
            
        </section>
    <!-- Pie de página -->
        <footer>- Copyright Colegio Don Bosco 2020 -</footer>
    </div>
</body>
</html>
