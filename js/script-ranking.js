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
        $.post("../controlador/getSubjectsbyGradeP.php",
            {
                "idGrado":grade
            },
            function(block){
                $(boxSubjects).empty();
                $(boxSubjects).append(block);
            },
            "html");
  
}
