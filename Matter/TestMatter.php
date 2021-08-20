<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
$consulta=new Query;
    #si existe el Keyup
    if (isset($_POST['nombre'])) {
        $nombre=strtolower($_POST['nombre']);
        $NoDis=0;
        $verMat=$consulta->getMatter();
        $nMat=count($verMat);
        #lee los Nombres
        for ($i=0; $i <$nMat ; $i++) { 
            $verMat[$i]['nombre'];
           $NomMat=strtolower($verMat[$i]['nombre']);
           if ($nombre!=$NomMat) {
               
           }else {
            $NoDis=$NomMat;
            #guarda el nombre Igual
           }
        }
        if ($nombre==$NoDis) {
            $state=false;
            echo"El nombre no esta disponible";
        }elseif (empty($nombre)) {
            echo"Rellene el campo";
            $state=false;
        } else {
            $state=true;
            echo"El nombre esta disponible";
        }
        
    }else {
        echo "no se pudo no hay conexion";
    }



            /*if (isset($_POST['nombre'])) {
                //$nivel=$_POST['nivel'];
                $nombre=$_POST['nombre'];
                //$guardarNom=$consulta->saveNivel($nivel);
                $guardarMat=$consulta->savenombre($nombre);
                echo "Dato guardado ";
            }else {
                echo "no se pudo guardar";
            }*/
      ?>
      <script>
         state=<?php echo $state;?>
      </script>
