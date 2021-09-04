<?php
require_once("../modelo/conection.php");
require_once("../modelo/query.php");
$consulta=new Query;
    #si existe el Keyup
    if (isset($_POST['nombre'])) {
        $nombre=strtolower($_POST['nombre']);
        $NoDis=0;
        $verMat=$consulta->getLevel();
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
        #si el el input ya esta en la base de datos
        if ($nombre==$NoDis) {
            $state=false;
            echo"<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
            <strong class='font-bold'>Error!</strong>
            <span class='block sm:inline'>El nombre no esta disponible</span>
            <span class='absolute top-0 bottom-0 right-0 px-4 py-3'>
              <svg class='fill-current h-6 w-6 text-red-500' role='button' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><title>Close</title><path d='M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z'/></svg>
            </span>
          </div>";
           #si el el input ya esta vacio 
        }elseif (empty($nombre)) {
            echo"<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
            <strong class='font-bold'>Error!</strong>
            <span class='block sm:inline'>Rellene el campo</span>
            <span class='absolute top-0 bottom-0 right-0 px-4 py-3'>
              <svg class='fill-current h-6 w-6 text-red-500' role='button' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><title>Close</title><path d='M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z'/></svg>
            </span>
          </div>";
            $state=false;
        #si el el input no esta en la base de datos
        } else {
            $state=true;
            echo"<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative' role='alert'>
            <span class='block sm:inline'>El nombre esta disponible</span>
            <span class='absolute top-0 bottom-0 right-0 px-4 py-3'>
              <svg class='fill-current h-6 w-6 text-green-500' role='button' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><title>Close</title><path d='M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z'/></svg>
            </span>
          </div>";
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
         state="<?php echo $state;?>"
         //si el estado es falso desabilita el boton
            if (state==false) {
                $("#guardar").css("background-color","red")
                $("#guardar").prop("disabled", true);
            }else{
            //si no 
                $("#guardar").css("background-color","#4f46e5")
                $("#guardar").prop("disabled", false);
            }
      </script>
