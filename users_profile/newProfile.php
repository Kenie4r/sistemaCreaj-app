<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Nuevo Perfil</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script-newProfile.js"></script>
    <script src="../js/script-frmUserValidate.js"></script>
    <script src="../Dashboard/button.js"></script>
</head>
<body>
<?php
require('../Dashboard/Dashboard.php');
?>
    <section class="p-8">
        <form action="saveProfile.php" method="POST" class="w-full bg-gray-800 p-4 rounded-lg shadow-lg" name="frmProfile" id="frmProfile">
            <div class="flex justify-center lg:m-9">
                <h1 class="text-5xl text-gray-500">Nuevo Perfil</h1>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 m-9 text-gray-300">
                <div>
                    <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0">
                        <label for="txtNameProfile" class="p-2">Nombre:</label>
                        <input type="text" name="txtNameProfile" id="txtNameProfile" maxlength="50" class="p-1 w-full bg-gray-800 border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none" autofocus required>
                    </div>
                </div>
                <div>
                    <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0">
                        <label for="txtLastNameProfile" class="p-2">Apellido:</label>
                        <input type="text" name="txtLastNameProfile" id="txtLastNameProfile" maxlength="50" class="p-1 w-full bg-gray-800 border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none" required>
                    </div>
                </div>
                <div>
                    <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0">
                        <label for="txtUserProfile" class="p-2">Usuario:</label>
                        <input type="text" name="txtUserProfile" id="txtUserProfile" value="" class="p-1 w-full bg-gray-800 border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none" readonly>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 m-9 text-gray-300">
                <div>
                    <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0">
                        <label for="txtEmailProfile" class="p-2">EMAIL:</label>
                        <div>
                            <input type="email" name="txtEmailProfile" id="txtEmailProfile" class="p-1 w-4/5 bg-gray-800 border-b-2 border-solid border-gray-900 focus:border-red-500 outline-none" required>
                            <input type="checkbox" name="ckEmail" id="ckEmail" class="hidden" disabled>
                            <label for="ckEmail"><span id="lbEmail" class="icon-cross text-red-500"></span></label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0">
                        <label for="txtPassProfile" class="p-2">Password:</label>
                        <input type="password" name="txtPassProfile" id="txtPassProfile" value="donboscoSV" class="p-1 w-full bg-gray-800 border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none" title="donboscoSV" readonly>
                    </div>
                </div>
                <div>
                    <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0">
                        <label for="txtRolProfile" class="p-2">Rol:</label>
                        <select name="txtRolProfile" id="txtRolProfile" class="p-1 w-full bg-gray-800 border-b-2 border-solid border-gray-900 focus:border-gray-500 outline-none" required>
                            <option value="">Escogue un rol...</option>
    <?php

    if($_SESSION['rol'] == "a"){
    ?>
                            <option value="a">Administrador</option>
    <?php
    }

    ?>
                            <option value="c">Técnico - Científico</option>
                            <option value="j">Jurado</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="lg:m-2">
                    <a href="#" id="btnSubmit" class="block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700"><span class="icon-checkmark"></span> Guardar</a>
                </div>
                <div class="mb-2 lg:m-2">
                    <a href="index.php" class="block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-red-600"><span class='icon-cross'></span> Cancelar</a>
                </div>
            </div>
        </form>
    </section>
</body>
</html>