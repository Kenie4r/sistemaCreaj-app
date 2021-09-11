
<?php
    require('composer/vendor/autoload.php');
    require_once("../modelo/query.php");
    require_once("../modelo/conection.php");
    require_once("soporteStudents.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Subir por excel</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../Dashboard/button.js"></script>
    <script src="../Dashboard/js/button2.js"></script>
</head>
<body class="bg-">
<?php
require('../Dashboard/Dashboard.php');  
?>
    <section id="Caja">
        <?php
            class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter {
                public function readCell($column, $row, $worksheetName = ''){

                    if($row>1){
                        return true;

                    }
                    return false;
                }
            }
            $reader= new \PhpOffice\PhpSpreadsheet\Reader\XLs();
            $inputFileName = $_FILES['txt_archivo']['tmp_name'];

            $inputFileType =\PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);

            $reader= \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

            $reader->setReadFilter(new MyReadFilter() );

            $spreadsheet= $reader -> load($inputFileName);

            $cantidad= $spreadsheet->getActiveSheet()->toArray();

            foreach($cantidad as $row){

                if($row[0] !=''){
                    $modelo = new Conection;
                    $conexion = $modelo->_getConection();
                    $consulta = "INSERT INTO estudiante(idestudiante, nombre, apellidos, grado_idgrado) VALUES ('".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."')";
                    $sentencia = $conexion->prepare($consulta);
                    $sentencia->execute();
                    ?>
                    <section class="container">
                        <div class="m-4 lg:m-7 bg-green-500 border-2 border-solid border-green-800 rounded-lg">
                            <div class="m-4 lg:m-7 text-center">
                                <p class="lg:text-4xl text-green-900">se ha guardado con éxito los datos de los estudiantes.</p>
                            </div>
                            <div class="m-4 lg:m-7 flex justify-center">
                                <a href="index.php" class="text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-green-500 hover:bg-green-700 cursor-pointer"><span class="icon-circle-left"></span> Regresar</a>
                            </div>
                        </div>
                    </section>
                    <?php
                }
            }
        ?>
       
    </section>

</body>
</html>
