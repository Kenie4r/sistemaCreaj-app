<?php
    require('../modelo/conection.php');
    require('../modelo/query.php');

    $query = new Query;
    $resultado = $query->getRange($_POST['idCriterio'], $_POST['gradeName']);
    $html ="<div class= 'p-5 flex flex-col content-center items-center '>" 
    "<div  class='bg-gray- 200 borderb-2 border-black flex flex-row justify-start items-center w-full cursor-pointer'>
            "<div  class='bg-gray-300 p-3 font-bold text-xl backbutton' id='btnBack_NUMBER'><</div>
            "<div class='mx-2 font-bold text-xl'><h1>Nivel de rango escogido <span id= max_NUMBER> nivel</span></h1></div>"
    "</div>"
   "<div class='w-full text-center'>"
        "<h1> Descripción del rango obtenido</h1>"
            "<p class='text-justify p-2'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum veniam ea unde mollitia aspernatur, asperiores at deleniti consequatur? Nam, quod natus. Tempora amet mollitia totam voluptas praesentium dolorem, molestias placeat.</p>" 
    "</div>"
    "<div class='w-full text-center font-bold m-2'>"  
        "<p>La nota obtenida es:</p>" 
        "<h1 class='text-4xl cursor-pointer notas' id='nota_"NUMBER"'  value='"notas[0]"'>"notas[1]"</h1>"
    "</div>"
    "<div  class='flex flex-row mt-2'>"
      "<div class='mx-2'>"notas[1] "</div>"
        "<div>"
            "<input type='range' class='gradeinput rounded-lg' max=" notas[0]" min="notas[1]" step='0.1' value=" notas[1]" id='Grade_" NUMBER "' required>"
        "</div>"
        "<div class='mx-2'>" notas[0]"</div>"
    "</div>"
    "<div  class='text-center m-2'>"
            "<div class='border-2 border-blue-400 bg-blue-400 text-white p-1 rounded-lg cursor-pointer btnGuardar' id='btnG_"NUMBER"'>Guardar</div>"
   "</div>"
"</div> "



?>