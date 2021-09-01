
//funciones luego de que nuestro archivo cargue
$(document).ready(function(){


    var fullGrade = 0;
    $('.calificaciones').fadeOut('fast');
   mainActivity();

    $('#btnTerminar').click(function(){
        var nota = $('#inputGrade').val();
        if( nota==""){
            crearNotificacion(1, "Aún no has terminado de calificar", null , "Ok");
        }else{
            var contador = 0;
            var notasCriterios = document.getElementsByClassName('final');
            for (let index =1; index <   notasCriterios.lenght; index++) {
                if(notasCriterios[index].value==""){
                    contador++;
                }
            }
            if (contador==0 ){
                crearNotificacion(1, "¿Quiéres guardar la nota?","Guardar", "Cancelar")
            }else{
                crearNotificacion(1, "Aún no has terminado de calificar", null , "Ok");
            }
 
        }

    })
});


function funcionamiento(){
    //funcionamiento de editar
    $('.btnEdit').click(function(){
        idBox= id_Number($(this).attr('id'));
        var minusGrade = $('#Final' + idBox).val();
        var NewGrade = parseFloat($('#finalGrade').text())
        NewGrade-= minusGrade;
        $('#finalGrade').text(NewGrade.toFixed(2));
        var width = NewGrade+"%";
        $('#progress').css('width', width);
        var box = "#div"+idBox;
        $(box).fadeIn('slow')//esta hace que aparezca
        $('#calificar'+idBox).empty();    
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
    mainActivity();
    sencondActivity()
    
}

function mainActivity(){
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
        notaDiv+=divNumber;
        nivel = definirNivel(rangoGanado);
        $(contenedor).fadeOut('fast');
        $(descripDiv).fadeOut('fast');
        //función de escribir el input
        inputCreation(divNumber, divCalificar , nivel)
        $(divCalificar).fadeIn('slow');
        //Funcionanmiento del botón de volver atras y demás
            sencondActivity()
        } )
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
             var idBox  = id_Number(  $(this).attr('id'));
             var input = "#Grade_"+ idBox;
             var grade = $(input).val();
            var  gradeEnd = grade *  ($('#valor' + idBox).val()/100);
             var nowGrade = $('#finalGrade').text();
             var NewGrade = parseFloat(nowGrade);
             NewGrade+= gradeEnd;
             if( NewGrade<=100){
                 $('#finalGrade').text(NewGrade.toFixed(2));
                 var width = NewGrade+"%";
                 $('#progress').css('width', width);
             }
             $('#Final' + idBox).val(gradeEnd.toFixed(2));
             $('#calificar' + idBox).empty();
             var text = escribirNotaFIn(grade, idBox);
             $('#descr' + idBox).fadeIn('slow');
             $('#calificar' + idBox).append(text);
            $('#inputGrade').val( NewGrade);
             //funcionamiento de editar
             $('.btnEdit').click(function(){
                 idBox= id_Number($(this).attr('id'));
                 var minusGrade = $('#Final' + idBox).val();
                 NewGrade-= minusGrade;
                 $('#finalGrade').text(NewGrade.toFixed(2));
                 var width = NewGrade+"%";
                 $('#progress').css('width', width);
                 var box = "#div"+idBox;
                 $(box).fadeIn('slow')//esta hace que aparezca
                 $('#calificar'+idBox).empty();
                 $('#Final' + idBox).val("")
             })
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
        "idNumber": number
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
            nMin = 40;
            nMax = 69;
        break;
        case "Básico":
            nMin = 70;
            nMax = 79;
        break;
        case "Autónomo":
            nMin = 80;
            nMax = 89;
        break;
        case "Estratégico":
                nMax = 100;
                nMin = 90;
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
        color = "bg-redd-500"
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
    "<div class='bg-white max-w-sm text-center opacity-100 p-2 flex flex-col items-center justify-center w-full sm:max-w-md'>"+
    "<div class='w-10 h-10 "+ color + " text-white text-2xl flex items-center justify-center rounded-full'>"+
     "   <span class='"+classIcon+"'></span>"+
    "</div>"+
   "<div class='text-lg'>"+
    "<h1>"+mensaje+"</h1>"+
    "</div>"+ opciones
"</div>";

    document.body.innerHTML += notification;


    $('#option-1').click(function(){
        $('#form').submit();
    })
    $('#option-2').click(function(){
        $('#notification').remove();
        funcionamiento();
    })


}