<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");

function primeraVez(){
    $consulta = new Query; //Crear una consulta
    $username = $_SESSION["uid"];
	$usuario = $consulta->getUsersByUsername($username);

	if ($usuario[0]["password"] == "6e8bf488a257263be3f2913f43dc7ddf"){
?>
		<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
			<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
				<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <!-- Contenedor alerta -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="flex flex-col">
                        <div class="flex flex-row items-center gap-4 pt-6 px-6">
                            <div>
                                <p class="rounded-full bg-red-900 w-8 h-8 flex items-center justify-center text-red-300"><span class="icon-warning"></span></p>
                            </div>
                            <div>
                                <p class="text-2xl leading-6 font-medium text-red-900">Primer inicio de sesión</p>
                            </div>
                        </div>
                        <div class="p-6 text-justify">
                            <p class="">Bienvenido/a al sistema de calificación de CreaJ, al 
                                ser tu primer inicio de sesión todavía tienes una contraseña 
                                por defecto que pone en peligro tu usuario (es la contraseña 
                                que se te envió por correo); es por ello que tu primer acción 
                                para tener completo acceso al sistema es cambiar tu contraseña 
                                por una que solo tu conozcas.</p>
                        </div>
                    </div>
                    <div class="pb-6 flex justify-center items-center">
                        <a href="../profile/editPassword.php?primeraVez=1" class="block text-blue-600 border-blue-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-blue-600"><span class='icon-pencil'></span> Cambiar contraseña</a>
                    </div>
				</div>
			</div>
		</div>
<?php
	} 
}
?>