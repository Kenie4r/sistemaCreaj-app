<?php

require_once("../modelo/conection.php");
require_once("../modelo/query.php");
require_once("soporteStudents.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Nueva Estudiante</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script-newStudents.js"></script>
    <script src="../Dashboard/button.js"></script>
    <script src="../Dashboard/js/button2.js"></script>
    <?php
require('../Dashboard/Dashboard.php');
require_once("../parameters/soporteParametros.php");
comparacionFecha("Ingreso de estudiantes");
?>
    <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
              applyInputMask('txtCodigo', '0--0*0 000_000');
            });
            document.addEventListener('DOMContentLoaded', function() {
              applyInputMask2('txtApellidos', '0--0*0 000_000');
            });
            document.addEventListener('DOMContentLoaded', function() {
              applyInputMask2('txtNombres', '0--0*0 000_000');
            });
            function applyInputMask(elementId, mask) {
          let inputElement = document.getElementById(elementId);
          let content = '';
          let maxChars = numberCharactersPattern(mask);
          
          inputElement.addEventListener('keydown', function(e) {
            e.preventDefault();
            if (isNumeric(e.key) && content.length < maxChars) {
              content += e.key;
            }
            if(e.keyCode == 8) {
              if(content.length > 0) {
                content = content.substr(0, content.length - 1);
              }
            }
            inputElement.value = maskIt('00000000', content);
          })
        }
        function applyInputMask2(elementId, mask) {
          let inputElement = document.getElementById(elementId);
          let content = '';
          
          inputElement.addEventListener('keydown', function(e) {
            e.preventDefault();
            if (!isNumeric(e.key) && content.length < 20) {
                if(e.keyCode >= 65 && e.keyCode <= 90 ||  e.keyCode == 32)
                    content += e.key;
            }
            if(e.keyCode == 8) {
              if(content.length > 0) {
                content = content.substr(0, content.length - 1);
              }
            }
            inputElement.value = content;
          })
        }
        function maskIt(pattern, value) {
          let position = 0;
          let currentChar = 0;
          let masked = '';
          while(position < pattern.length && currentChar < value.length) {
            if(pattern[position] === '0') {
              masked += value[currentChar];
              currentChar++;
            } else {
              masked += pattern[position];
            }
            position++;
          }
          return masked;
        }
        function numberCharactersPattern(pattern) {
          let numberChars = 0;
          for(let i = 0; i < pattern.length; i++) {
            if(pattern[i] === '0') {
              numberChars ++;
            }
          }
          return numberChars;
        }
        function isNumeric(char) {
          return !isNaN(char - parseInt(char));
        }
    </script>
</head>
<body class="bg-">

    <form id="frmNewStudents" class="container box-content" method="POST" action="saveStudents.php">
        <h1 class="lg:justify-center text-center lg:w-3/4 lg:w-full lg:text-5xl md:text-2xl sm:text-2xl outline-none focus:border-gray-500 border-b-2 focus:border-solid mt-8">Agregar estudiante</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="flex lg:m-9">
                <div class="lg:m-2 sm:ml-7">
                    <p id="btnSubmit" onclick="this.submit();" class="lg:m-5 md:m-3 sm:m-3 block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700 cursor-pointer"><span class="icon-checkmark"></span> Guardar</p>
                </div>
                <div class="mx-2 lg:m-2">
                    <a href="index.php" class="lg:m-5 md:m-3 sm:m-3 block text-red-600 border-red-600 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-red-600"><span class='icon-cross'></span> Cancelar</a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 m-8">
            <div>
                <div class=" flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                    <label for="txtID" class="p-2 bg-gray-700 text-white ">Código</label>
                    <input class="w-1/4	 p-1.5   lg:w-full  outline-none focus:border-gray-500 border-b-2 focus:border-solid" required type="text" name="txtCodigo" id="txtCodigo" value="" >
                    <label for="txtNombreProyecto" title="Editar" ><span class="hidden lg:block icon-pencil"></span></label>
                </div>
            </div>
                <div> 
                    <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                        <label for="txtID" class="p-2 bg-gray-700 text-white">Nombre</label>
                        <input class="w-1/4	  p-1.5  lg:w-full  outline-none focus:border-gray-500 border-b-2 focus:border-solid" required type="text" name="txtNombre" id="txtApellidos" value="" >
                        <label for="txtNombreProyecto" title="Editar" ><span class="hidden lg:block icon-pencil"></span></label>
                    </div>
                </div>
                <div> 
                    <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                        <label for="txtID" class="p-2 bg-gray-700 text-white">Apellido</label>
                        <input class="w-1/4	 lg:w-full p-1.5 outline-none focus:border-gray-500 border-b-2 focus:border-solid" required type="text" name="txtApellido" id="txtNombres" value="" >
                        <label for="txtNombreProyecto" title="Editar" ><span class="hidden lg:block icon-pencil"></span></label>
                    </div>
                </div>
                <div class="mt-10">  
                    <div class="flex flex-row items-center w-full lg:w-4/5 mb-7 lg:m-0 border-gray-700 border-solid border-2 rounded-lg">
                        <label for="txtID" class="p-2 bg-gray-700 text-white">Grado:</label>
                        <select name="txtGrado" required id="txtGrado" class="p-1 w-full rounded-r-lg outline-none">
                            <?php writeLevelForNewRubric(); ?>
                        </select>
                    </div>
                </div>
            </div>
       </div>
       <div class="grid grid-cols-1 lg:grid-cols-2">
           <div class="flex lg:m-9 sm:ml-72">
               <div class="lg:m-2">
                    <a href="subirexcel.php" id="btnSubmit" class="block text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-white hover:bg-green-700"><span class="icon-file-text"></span> Subir datos por Excel</a>
                </div>
           </div>
       </div>
      
        <div>
            <?php
                if(isset($_POST['btn'])){
                   
                   
                }
          
            ?>


        </div>
    </form>
</body>
</html>   
        