<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Editar contraseña</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script-editPasswordUser.js"></script>
    <script src="../Dashboard/button.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
?>
    <section class="p-8">
        <form action="updatePassword.php" method="POST" class="w-full bg-gray-800 p-4 rounded-lg shadow-lg" name="frmPassword" id="frmPassword">
            <div class="flex items-center justify-center text-gray-500 flex-col">
                <h1 class="text-5xl"><?php echo $_SESSION["usario"]; ?></h1>
                <h2 class="text-2xl">Cambiar contraseña</h2>
            </div>
            <input type="hidden" name="actualName" id="actualName" value="<?php echo $_SESSION["usario"]; ?>">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="flex flex-col items-center m-8 rounded-lg">
                    <label for="txtNewPassProfile" class="text-white">Nueva Password:</label>
                    <input type="password" name="txtNewPassProfile" id="txtNewPassProfile" class="p-1 w-4/5 bg-gray-800 border-b-2 border-solid border-gray-900 focus:border-gray-600 outline-none" size="10" maxlength="10" autofocus>
                </div>
                <div class="flex flex-col items-center w-full m-8 rounded-lg">
                    <label for="txtConfirmPassProfile" class="text-white">Confirmar nueva password:</label>
                    <div>
                        <input type="password" name="txtConfirmPassProfile" id="txtConfirmPassProfile" class="p-1 bg-gray-800 border-b-2 border-solid border-gray-900 focus:border-red-500 outline-none" maxlength="10">
                        <input type="checkbox" name="ckConfirmPass" id="ckConfirmPass" class="hidden" disabled>
                        <label for="ckConfirmPass"><span id="lbConfirmPass" class="icon-cross text-red-500"></span></label>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <div class="flex flex-col items-center w-full m-8">
                    <label for="txtActualPassProfile" class="text-white">Antigua Password:</label>
                    <div>
                        <input type="password" name="txtActualPassProfile" id="txtActualPassProfile" class="p-1 w-4/5 bg-gray-800 border-b-2 border-solid border-gray-900 focus:border-red-500 outline-none" title="donboscoSV">
                        <input type="checkbox" name="ckActualPass" id="ckActualPass" class="hidden" disabled>
                        <label for="ckActualPass"><span id="lbActualPass" class="icon-cross text-red-500"></span></label>
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-center">
                <div class="lg:m-2">
                    <a href="#" id="btnSubmit" class="block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700"><span class="icon-checkmark"></span> Guardar</a>
                </div>
                <div class="mb-2 lg:m-2">
                    <a href="../Dashboard/profile.php" class="block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-red-600"><span class='icon-cross'></span> Cancelar</a>
                </div>
            </div>
        </form>
    </section>
</body>
</html>