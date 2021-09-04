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
            $blockhtml = "";
            $query = new Query();
            $grados = $query->getGrado();
            foreach($grados as $campo){
               //vamos a escribir cada uno de los grados dentro del box
               $blockhtml .= "<div class='bg-white w-full shadow-xl p-2 flex flex-row justify-between my-2'>
               <!--Primero irá el nombre del grado-->
               <div class='text-center'>
                   <h1 class='text-2xl'>{$campo['nombre']}  {$campo['seccion']}</h1>
               </div>
               <!--Un botón para seleccionar al grado-->
               <div>
                   <div class='button p-2 border border-2 bg-blue-300 text-white cursor-pointer btnGrade' id='btn-{$campo['idgrado']}'>
                       <p>Ver proyectos</p>
                   </div>
               </div>
                </div>";
            }
            $blockhtml.="</div>
            </div>";
            print($blockhtml);

        }
        public function creatematerias(){
            $html = <<<EDO
            <div class='materias bg-white w-full h-full h-3/6 p-5 flex flex-col items-center md:h-full '>
            <div class='text-xl my-2'>
                <h1>Seleccione una materia para descargar su PDF</h1>
            </div>
            <div class='w-10/12 overflow-auto  md:h-full' id='boxSubjects'>
                <p class="text-gray-400 text-2xl text-center">Aún no has seleccionado ningún grado, por favor seleccione uno <span class="icon-cross"></span></p>
          
            </div>
            </div>
            </div>
            </div>
            </body>
            </html>
            EDO;

            print($html);
        }


    }

?>