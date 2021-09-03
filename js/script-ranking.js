var projectID, subjectID;//son los id para nuestro grado y materia respectivamente}+
var boxSubjects = "#boxSubjects";
$(document).ready(function(){
    $('.btnGrade').on('click', function(){
        grade = getID($(this).attr('id'));
        getSubjectsbyGrade();
    })

})



function getID(myID){
    var splitedID = myID.split('-');
    return splitedID[1];
}

function getSubjectsbyGrade(){
    var block = "      <div class='bg-white w-full shadow-xl p-2 flex flex-row justify-between my-2'>"+
    "<!--Primero  va el normbre de  la materia-->"+
    "<div class='text-center'>"+
        "<h1 class='text-2xl'>Religión</h1>"+
    "</div>"+
"<!--Un botón para descargar el PDF-->"+
    "<div>"+
        "<div class='button p-2 border border-2 bg-blue-300 text-white cursor-pointer btnSubject' id='btnM-1'>"+
            "<p>Descargar PDF</p>"+
        "</div>"+
    "</div>"+
"</div>";
    $(boxSubjects).empty();
    $(boxSubjects).append(block);
}
