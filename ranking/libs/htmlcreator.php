<?php
    class ranking{
        public function header(){
            $html = <<<EDO
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Ranking</title>
                <link href='https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css' rel='stylesheet'>
                <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
                <link rel='stylesheet' href='../recursos/icons/style.css'>
                <link rel='stylesheet' href='../recursos/icons/style.css'>
                <script src='../js/script-ranking.js'></script>
            </head>
            <body>
            EDO;

            print($html);
        }

        public function body(){

            $html = <<<EDO
            <div class='h-screen w-screen flex flex-col p-5 items-center justify-center rounded-2xl shadow bg-gray-100'>
            <div class='container h-screen w-screen border shadow-lg bg-white flex flex-col md:flex-row '>
                    <div class='grados bg-blue-900 w-full h-3/6 rounded-md flex flex-col items-center md:h-full'>
                        <div class='text-white my-2 text-justify p-5'>
                            <h1 class='text-center text-xl'>Selección de grados para ver el Ranking</h1>
                            <p>Seleccione un grado, luego en el apartado de materias seleccione la materia
                                 para poder ver el PDF donde aparecen todos los proyectos con los 3 mejor calificados.</p>
                        </div>
                        <div class='w-10/12 overflow-auto md:h-full'>
            EDO;

            print($html);
        }
        public function generateGrades(){
            $query = new Query();
            $grados = $query->getGrado();
            foreach($grados as $campo){
                foreach($campo as $data){
                    echo($data);

                }

            }


        }

    }

?>