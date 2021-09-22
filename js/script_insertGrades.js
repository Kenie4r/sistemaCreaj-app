//definición de las vartiables globales
var notafinal = 0;

//funciones luego de que nuestro archivo cargue
$(document).ready(function(){
    var screen = $('#cargar');

    loadingnotification(screen);
    //usos del botón terminar, para revisar 
    terminarCalificar();
    //calificar 
    mainActivity();
});
function bloquearInputs(input){
       var criteriosdiv = document.getElementsByClassName('criterio');
       for(let count = 0; count<criteriosdiv.length; count++){
           if( $(input).attr('id')==criteriosdiv[count].id  ){

           }else{
              $("#" +  criteriosdiv[count].id ).fadeOut('fast');
           }
       }
}
function inputsGet(){
      var criteriosdiv = document.getElementsByClassName('criterio');
       for(let count = 0; count<criteriosdiv.length; count++){
              $("#" +  criteriosdiv[count].id ).fadeIn('fast');
       }
}

//función para poder guardar la notas, pero antes verificando los inputs
function terminarCalificar(){

    document.getElementById('btnTerminar').addEventListener("click", function(e){
        if($('#inputGrade').val() == "" || $('#inputGrade')==NaN){
            crearNotificacion(1, "Aún no has calificado", null, "Terminar");
        }else{
            var inputsCalificados = 0;
            var inputsCriterios = document.getElementsByClassName('final');
            for(let i = 0; i<inputsCriterios.length; i++){
                if( inputsCriterios[i].value=="" ||  inputsCriterios[i].value==NaN || inputsCriterios[i].value==0 ){
                    inputsCalificados++
                }
            }
            if(inputsCalificados == 0){
                crearNotificacion(1,"¿Quieres guardar?", "Sí", "Aún no");
            }else{
                crearNotificacion(1, "Aún no has terminado de calificar", null , "Ok");
            }
        }
    })
}
function editarNota(){
    //funcionamiento de editar
    $('.btnEdit').click(function(){
        idBox= id_Number($(this).attr('id'));
        var minusGrade = $('#Final' + idBox).val();
        var NewGrade = parseFloat($('#finalGrade').text())
        NewGrade-= minusGrade;
        $('#finalGrade').text(NewGrade.toFixed(3));
        var width = NewGrade*2+"%";
        $('#progress').css('width', width);
        var box = "#div"+idBox;
        $(box).fadeIn('slow')//esta hace que aparezca
        $('#calificar'+idBox).empty();    
        $('#inputGrade').val(NewGrade);
     })
  $('#btnTerminar').click(function(){
        var nota = $('#inputGrade').val();
        var faltan = false;
        var inputs = document.getElementsByClassName('final');
        for(var index = 0; index<inputs.length; index++){
            if(inputs[index].value ==0){
                faltan = true;
            }
        }
        if( nota==""){
            crearNotificacion(1, "Aún no has terminado de calificar", null , "Ok");
        }else{
            if (faltan==true ){
                crearNotificacion(1, "Aún no has terminado de calificar", null , "Ok");
            }else{
                crearNotificacion(1, "¿Quiéres guardar la nota?","Guardar", "Cancelar");
            }
        }

    });
  //  mainActivity();
    //sencondActivity()
    
}
//funcionamiento de los botones de nivle y demás
function mainActivity(){
    $('.promedios').click(function(){
   
        var div = "#div", divCalificar = "#calificar", notaDiv = "#nota", descripDiv = "#descrp";
        var idPromedio = $(this).attr('id').split('_');
        var numeroDiv = idPromedio[1];
        var nombreRango = definirNivel(idPromedio[0]);
        bloquearInputs( "#criterio"+numeroDiv);
        //hacer desaparecer los contenedores
        $(div + numeroDiv).fadeOut('fast');
        $(descripDiv + numeroDiv).fadeOut('fast');
        //crear el input de calificar
        inputCreation(numeroDiv, divCalificar+numeroDiv, nombreRango);
        $(divCalificar+numeroDiv).fadeIn('slow');
        sencondActivity();
    })
};
function sencondActivity(){
    $('.backbutton').click(function(){
        
             var IDbtn = id_Number( $(this).attr("id"));
             var boxNumber = IDbtn
             var box = "#div"+boxNumber;
             var thisBox = "#calificar"+boxNumber;
             descripDiv   = "#descr"+boxNumber;
             //animaciones para hacer más bonito el cambio de bloques
             $(box).fadeIn('slow')//esta hace que desaparezca
             $(descripDiv).fadeIn('slow')
             $(thisBox).fadeOut('slow')//esta hace aparecer
             $(thisBox).empty()
              inputsGet()
         })
         //función para obtener, verificar el valor de la barra range que nos da  la nota
        $('.gradeinput').change( function(){      
             var value  = $(this).val();
             var IDbtn = id_Number( $(this).attr('id'));
             var boxNumber = IDbtn;
             var box = "#nota_"+boxNumber;
           $(box).text(value);
         })
         $('.notas').click(function(){
             var max= $(this).attr('value');
             $(this).text(max);
             var NumberId = id_Number($(this).attr('id'));
             var input = "#Grade_"+NumberId;
            $(input).val(max)
         })
         $('.btnGuardar').click(function(){
              inputsGet()
             var idBox  = id_Number(  $(this).attr('id'));
             var input = "#Grade_"+ idBox;
             var grade = $(input).val();
            var  gradeEnd = grade *  ($('#valor' + idBox).val()/100);
             var nowGrade = $('#finalGrade').text();
             var NewGrade = parseFloat(nowGrade);
             NewGrade+= gradeEnd;
             if( NewGrade<=50){
                 $('#finalGrade').text(NewGrade.toFixed(2));
                 var width = NewGrade*2+"%";
                 $('#progress').css('width', width);
             }
             $('#Final' + idBox).val(gradeEnd.toFixed(2));
             $('#calificar' + idBox).empty();
             var text = escribirNotaFIn(grade, idBox);
             $('#descr' + idBox).fadeIn('slow');
             $('#calificar' + idBox).append(text);
            $('#inputGrade').val( NewGrade.toFixed(2));
             //funcionamiento de editar
             editarNota();
        })
}

/*UNA DE LAS FUNCIONES MÁS IMPORTANTES, EN ESTA COMENZAMOS A ESCRIBIR TODO LO NECESARIO PARA GENERAR 
EL FORMULARIO PARA EL INGRESO DE LA NOTA, TENIENDO EN CUENTA A LAS SELECCIÓN ANTERIOR DE DATOS
COMO EL NIVEL Y EL CRITERIO ESCOGIDO ANTERIORMENTE POR EL USUARIO */
function inputCreation(number, contenedor, nivel){
    var notas   = ObtenerRNotas(nivel);
    $.post("../controlador/searchCriterio.php", {
        "idCriterio": $('#idC'+number).val(),
        "gradeName": nivel,
        "idNumber": number,
        "MinNota":notas[1],
        "MaxNota":notas[0]
    },function(result){
        $(contenedor).append(result);  
        sencondActivity();
    }, 
    "html");
}




/**************************************************************************************************
 ********************* AQUÍ COMIENZAN LAS FUNCIONES SECUNDARIAS **********************
 ***************************************************************************************************/

//función que se usara para obtener las notas desde la base de datos con AJAX
function ObtenerRNotas(nivel){
    var nMax, nMin;

    // por el momento ya que no se usa base de datos aun solo manejamos estas notas
    switch(nivel){
        case "Inicial receptivo":
            nMin = 0;
            nMax = 20;
        break;
        case "Básico":
            nMin = 21;
            nMax = 30;
        break;
        case "Autónomo":
            nMin = 31;
            nMax = 40;
        break;
        case "Estratégico":
                nMax = 50;
                nMin = 41;
        break;

    }
    return  [  nMax , nMin];
}

//pequeña función la cual no entrega solo el valor del ID, para facilitar la lectura del código
function id_Number(id){
  var idSplited = id.split("_");
  return idSplited[1];
}

//funcion de niveles

function definirNivel(rangoGanado){
    switch(rangoGanado){
        case "promedio1":
            nivel = "Inicial receptivo"
            break;
        case "promedio2":
            nivel = "Básico"
            break;
        case "promedio3":
            nivel = "Autónomo"
        break;
        case "promedio4":
            nivel = "Estratégico"
        break;
    }
    return nivel;
}


function escribirNotaFIn(grade, number){
    var text = "<div class='w-full text-center font-bold m-2 col-span-2'>"+  
        "<p>La nota obtenida en este criterio es:</p>"+ 
        "<h1 class='text-4xl  notas' id='notaFin" + number+ "'>"+ grade + "</h1>"+
        "</div>"+
    
        "<div class='w-60 m-auto text-lg text-center text-blue-500 border-blue-500  border-2 cursor-pointer p-1 hover:bg-blue-500 hover:text-white btnEdit' id='btnEdit_"+number+"'>"+
        "<span class='icon-pencil  '> EDITAR NOTA</span>"+
"   </div>";
     return text;
}



function crearNotificacion(tipo, mensaje, opcion1, opcion2){
    var classIcon, color, opciones, end;
    if(tipo==0){
        classIcon = "icon-cross";
        color = "bg-red-500"
    }else if( tipo == 1){
        color = "bg-yellow-500"
        classIcon = "icon-notification";
    }else if( tipo==2){
        classIcon  ="icon-checkmark"
        color = "bg-green-500"
    }
    if(opcion1!=null && opcion2!=null){
         opciones  = "<div class'flex flex-col text-sm '> <input type='submit' name='btnGuardar' value='"+opcion1 + " ' class='bg-gray-200 p-1 rounded-lg cursor-pointer m-1' id='option-1'>"+
             "</div>"+
            "<div class='bg-gray-200 p-1 rounded-lg cursor-pointer m-1' id='option-2' >"+
            "<h1>"+opcion2+"</h1>"+
             "</div></div>";
    }else if(opcion1!=null && opcion2==null){
        opciones  = "<div class='bg-gray-200 p-2 rounded-lg cursor-pointer ' id='option-1'>"+
        "<h1>"+opcion1+"</h1>"+
        "</div>";
    }else if(opcion1==null && opcion2!= null){
              opciones  = "<div class='bg-gray-200 p-2 rounded-lg cursor-pointer ' id='option-2' >"+
        "<h1>"+opcion2+"</h1>"+
        "</div>";
    }


    var notification  = "    <div id='notification' class='container  max-w-full  w-screen bg-gray-900 fixed h-screen bg-opacity-75 top-0  flex flex-col justify-center items-center'>"+
    "<div class='bg-white w.-5/12 h-3/6 text-center opacity-100 p-2 flex flex-col items-center justify-center w-full sm:max-w-md'>"+
    "<div class='w-10 h-10 "+ color + " text-white text-2xl flex items-center justify-center rounded-full'>"+
     "   <span class='"+classIcon+"'></span>"+
    "</div>"+
   "<div class='text-lg'>"+
    "<h1>"+mensaje+"</h1>"+
    "</div>"+ opciones
"</div>";

    document.body.innerHTML += notification;


    $('#option-1').click(function(){
    

        if(opcion1=="Volver atras"){
            window.location = "index.php";
        }else{
            var notafinal = $('#inputGrade').val(), team = $('#txtIdTeam').val();
            var user = $('#txtuserID').val(), materia = $('#materiaID').val(), grado = $('#gradoID').val();
            var inputsCriterio = document.getElementsByClassName('final');
            var porcentajes = document.getElementsByClassName('porcentajes');
            var inputsCriteriosID = document.getElementsByName('idCriterio');
            var notas = new Array(), criterios = new Array();
            for(var a = 0; a<inputsCriterio.length; a++){
                notas[a] = inputsCriterio[a].value / (porcentajes[a].value/100);
                criterios[a] = inputsCriteriosID[a].value;
             }
           $.post("libs/saveGrade.php",{
                'finalGrade': notafinal ,
                'txtIdTeam': team,
                'txtuserID':  user,
                'subjecttxt': materia,
                'levelttxt': grado,
                'notasc': notas,
                'criterios': criterios
            }, function(result){
                $('#notification').remove();
                document.body.innerHTML += result;
            }, 
            "html");
      }
    })
    $('#option-2').click(function(){
        $('#notification').remove();
      editarNota();
    })


}


function loadingnotification(screen){
    $(document)
        .ajaxStart(function(){
            screen.fadeIn();
        })
        .ajaxStop(function(){
            screen.fadeOut();
        })
}


/*function notificarCargar(){
    var html = "<div class='fixed  h-screen w-screen bg-gray-900 top-0 left-0  bg-opacity-70 flex  flex-col items-center justify-center hidden' id='cargar'>"+
        "<div class='bg-white h-3/6 w-5/12 rounded-lg flex justify-center flex-col items-center'>"+
          "  <div class='text-green-600 text-center w-6/12  text-8xl'>"+
                "<p class='animate-spin'>"+
                    "<span class='icon-spinner2'></span>"+
                "</p>"+    
            "</div>"+
            "<div class='animate-bounce m-2 text-2xl'>"+
               "<p>Cargando...</p>"+
            "</div>"+
        "</div>"+
    "</div>";
      document.body.innerHTML += html;
}*/