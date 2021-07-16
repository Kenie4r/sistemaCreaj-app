
//funciones luego de que nuestro archivo cargue
$(document).ready(function(){
    var fullGrade = 0;
    $('.calificaciones').fadeOut('fast');
   $('.promedios').click(function(){
       var nivel = "basico";
        var divNumber = '1';
        var contenedor = "#div"; var divCalificar = "#calificar";
        var notaDiv = "#nota"; var descripDiv   = "#descr";
        var id= $(this).attr("id");
      if(id.includes("_")){
            var splitTextID = id.split('_');
            divNumber = splitTextID[1];
            
            contenedor+= divNumber;
            var rangoGanado = splitTextID[0];

        }else{
            rangoGanado  = id;
           contenedor+=divNumber;
        }
        divCalificar+=divNumber;
        descripDiv+=divNumber;
        switch(rangoGanado){
            case "promedio1":
                nivel = "Básico"
                break;
            case "promedio2":
                nivel = "Bueno"
                break;
            case "promedio3":
                nivel = "Muy bueno"
            break;
            case "promedio4":
                nivel = "Excelente"
            break;
            default:
                nivel = "indefinido";
        }
        notaDiv+=divNumber;
  
        $(contenedor).fadeOut('fast');
        $(descripDiv).fadeOut('fast');
        //función de escribir el input
        inputCreation(divNumber, divCalificar , nivel)
        $(divCalificar).fadeIn('slow');
        //volver atras boton
        $('.backbutton').click(function(){
            var id = $(this).attr("id");
            var IDbtn = id.split("_");
            var boxNumber = IDbtn[1]
            var box = "#div"+boxNumber;
            var thisBox = "#calificar"+boxNumber;
            descripDiv   = "#descr"+boxNumber;
            $(box).fadeIn('slow')
            $(descripDiv).fadeIn('slow')
      
            $(thisBox).fadeOut('slow')
            $(thisBox).empty()
        })
        //aumento de barra
        $('.gradeinput').change(function(){
            var value  = $(this).val();
            var id  = $(this).attr('id');
            var IDbtn = id.split("_");
            var boxNumber = IDbtn[1]
            var box = "#nota"+boxNumber;
            $(box).text()
        })
        $('.notas').click(function(){
    
            $(this).text("10");
        })
    });
});

//genera el input más todos aqullos datos del front-end, con ayuda de AJAX se obtendrán datos como descripciones y 
//también la nota máxima que este pude llegar a tener
function inputCreation(number, contenedor, nivel){
    var gradeInput = " <div class= 'p-5 flex flex-col content-center items-center '>" +
    "<div  class='bg-gray-200 borderb-2 border-black flex flex-row justify-start items-center w-full cursor-pointer'>"+
            "<div  class='bg-gray-300 p-3 font-bold text-xl backbutton' id='btnBack_"+number+"'><</div>" +
            "<div class='mx-2 font-bold text-xl'><h1>Nivel de rango escogido "+nivel+"</h1></div>"+
    "</div>"+
   "<div class='w-full text-center'>"+
        "<h1> Descripción del rango obtenido</h1>"+
            "<p class='text-justify p-2'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum veniam ea unde mollitia aspernatur, asperiores at deleniti consequatur? Nam, quod natus. Tempora amet mollitia totam voluptas praesentium dolorem, molestias placeat.</p>" +
    "</div>"+
    "<div class='w-full text-center font-bold m-2'>"+  
        "<p>La nota obtenida es:</p>"+ 
        "<h1 class='text-4xl cursor-pointer notas' id='nota"+number+"'>0</h1>"+
    "</div>"+
    "<div  class='flex flex-row mt-2'>"+
        "<div class='mx-2'>1</div>"+
        "<div>"+
            "<input type='range' class='gradeinput rounded-lg' max='10' min='8.9' step='0.1' value='0' id='Grade"+ number+ "'>"+
        "</div>"+
        "<div class='mx-2'>"+
            "10"+
       "</div>"+
    "</div>"+
    "<div  class='text-center m-2'>"+
            "<div class='border-2 border-blue-400 bg-blue-400 text-white p-1 rounded-lg cursor-pointer'>Guardar</div>"+
   "</div>"+
"</div> ";
    $(contenedor).append(gradeInput);     
}