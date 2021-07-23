<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea J | Guardar rúbrica</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/icons/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<?php
echo "Nombre: " . $_POST["txtNombreRubrica"] . " - ";
echo "ID: " . $_POST["txtID"] . " - ";
echo "Materia: " . $_POST["txtMateria"] . " - ";
echo "Nivel: " . $_POST["txtNivel"] . " - ";
echo "Cantidad de criterios: " . $_POST["nCriterios"] . " - ";
$numeroCriterios = $_POST["nCriterios"];

for($i = 1; $i <= $numeroCriterios; $i++){
    $nameC = $i . "-txtNombreCriterio";
    $puntajeC = $i . "-nbPuntaje";
    echo "<div>";
    echo "<p>" . $_POST[$nameC] . "</p>";
    echo "<p>" . $_POST[$puntajeC] . "</p>";
    for($j = 1; $j <= 4; $j++){
        $nameN = $i . "-" .  $j . "-descripcionNivel";
        echo "<p>Muy malo: " . $_POST[$nameN] . "</p>";
    }
    echo "</div>";
}
?>
    <section class="container">
        <div class="m-4 lg:m-7 bg-green-500 border-2 border-solid border-green-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-green-900">La rúbrica se ha guardado con éxito.</p>
            </div>
            <div class="m-4 lg:m-7 flex justify-center">
                <a href="index.php" class="text-green-700 border-green-700 border-2 border-solid rounded-lg p-2 hover:text-green-500 hover:bg-green-700 cursor-pointer"><span class="icon-circle-left"></span> Regresar</a>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="m-4 lg:m-7 bg-red-400 border-2 border-solid border-red-800 rounded-lg">
            <div class="m-4 lg:m-7 text-center">
                <p class="lg:text-4xl text-red-900">Sucedio un error, la rúbrica no se ha guardado correctamente.</p>
            </div>
            <div class="m-4 lg:m-7 flex justify-center">
                <a href="index.php" class="text-red-700 border-red-700 border-2 border-solid rounded-lg p-2 hover:text-red-400 hover:bg-red-700 cursor-pointer"><span class="icon-circle-left"></span> Regresar</a>
            </div>
        </div>
    </section>
</body>
</html>