<?php
    require('../modelo/conection.php');
    require('../modelo/query.php');
    $number = $_POST['idNumber'];
    $query = new Query;
    $resultado = array();
  $array= $query->getRange($_POST['idCriterio'], $_POST['gradeName']);
    foreach($array as $r){
        $resultado[] = $r;
    }
    $max = $resultado[3];
    $min = $max - 25;
    header('Content-Type : application/json');
    $array= array(
        "ID"=>$resultado[0],
        "Descr"=>$resultado[0],
        "Name"=>$resultado[1],
        "Range"=>$resultado[2],
        "Max"=>$resultado[3],
        "IDC"=>$resultado[4]
    );

echo json_encode($array);

  /*
    $html ="<div class= 'p-5 flex flex-col content-center items-center '> 
    <div  class='bg-gray- 200 borderb-2 border-black flex flex-row justify-start items-center w-full cursor-pointer'>
            <div  class='bg-gray-300 p-3 font-bold text-xl backbutton' id='btnBack_$number'><</div> 
            <div class='mx-2 font-bold text-xl'><h1>Nivel de rango escogido <span id= max_number> $resultado[2]</span></h1></div>
    </div>
   <div class='w-full text-center'>
        <h1> Descripción del rango obtenido</h1>
            <p class='text-justify p-2'>{$resultado[1]}</p> 
    </div>
    <div class='w-full text-center font-bold m-2'>  
        <p>La nota obtenida es:</p> 
        <h1 class='text-4xl cursor-pointer notas' id='nota_$number'  value='$max'>$min</h1>
    </div>
    <div  class='flex flex-row mt-2'>
      <div class='mx-2'>$min </div>
        <div>
            <input type='range' class='gradeinput rounded-lg' max='$max' min='$min' step='0.1' value='$min' id='Grade_$number ' required>
        </div>
        <div class='mx-2'> $max</div>
    </div>
    <div  class='text-center m-2'>
            <div class='border-2 border-blue-400 bg-blue-400 text-white p-1 rounded-lg cursor-pointer btnGuardar' id='btnG_$number'>Guardar</div>
   </div>
</div> ";
*/
print($html);


?>