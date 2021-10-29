

window.onload = loaded 
function loaded(){
    $('#btnSearch').click(function(){
        $('#btnSearch').toggleClass("btn-aparecer");
        $('#btnSearch').toggleClass("btn-desaparecer");
        $('#divBusqueda').toggleClass("aparecer");
        $('#divBusqueda').toggleClass("desaparecer");
    });
    $('#btn-cerrar').click(function(){
        $('#btnSearch').toggleClass("btn-aparecer");
        $('#btnSearch').toggleClass("btn-desaparecer");
        $('#divBusqueda').toggleClass("aparecer");
        $('#divBusqueda').toggleClass("desaparecer");
    });

    $('.check_grados').on('click', function(){
        if($(this).is(':checked')){
            if($(this).attr('id')!="checkGrado_all"){
                $('#checkGrado_all').prop('checked', false);
            }else{
                var gradosCheck = document.getElementsByClassName('check_grados')
                for(var ix =1; ix < gradosCheck.length ; ix++){
                    gradosCheck[ix].checked = false;
                }
            }
        }
    })
    $('.check_subjects').on('click', function(){
        if($(this).is(':checked')){
            if($(this).attr('id')!="checkSub_all"){
                $('#checkSub_all').prop('checked', false);
            }else{
                var gradosCheck = document.getElementsByClassName('check_subjects')
                for(var ix =1; ix < gradosCheck.length ; ix++){
                    gradosCheck[ix].checked = false;
                }
            }
        }
    })

    $('#btnBuscar_Proyectos').click(function(){
        var materias, grados, nombreM,  nombreG;
        var SubjectCheck = document.getElementsByClassName('check_subjects')
        for(var ix = 0; ix < SubjectCheck.length ; ix++){
            if(SubjectCheck[ix].checked == true){
                materias = SubjectCheck[ix].value;
                nombreM = SubjectCheck[ix].dataset.name;
            }
        }  
        var gradosCheck = document.getElementsByClassName('check_grados')
        for(var ix =0; ix < gradosCheck.length ; ix++){
          if(gradosCheck[ix].checked == true){
              grados = gradosCheck[ix].value;
              nombreG = gradosCheck[ix].dataset.name;
          }
        }
        if(materias.length == 0 && grados.length == 0){
            Swal.fire({
                title: 'Error',
                text: 'No selecciono ningún filtro de proyectos',
                icon:  'error',
                confirmButtonText: 'Ok'
             })
        }else{
            if(materias.length==0){
                Swal.fire({
                    title: 'Error',
                    text: 'No selecciono ninguna materia',
                    icon:  'error',
                    confirmButtonText: 'Ok'
                 })
            } else if(grados.length==0){
                Swal.fire({
                    title: 'Error',
                    text: 'No selecciono ningún grado',
                    icon:  'error',
                    confirmButtonText: 'Ok'
                 })
            }else{
                document.getElementById('materiaB').value = materias;
                document.getElementById('gradoB').value = grados;
                if(nombreG==""){
                    nombreG = "Todos los grados"
                }
                if(nombreM == ""){
                    nombreM = "Todas las materias"
                }
                $('#filter-g').empty();
                $('#filter-g').append(nombreG)
                $('#filter-s').empty();
                $('#filter-s').append(nombreM);
                //vamos a buscar todos los proyecto con estos datos 
                $.post("../controlador/get_project-filter.php", {
                    "userID" : $('#userID').val(),
                    "grado" : $('#gradoB').val(),
                    "materias" : $('#materiaB').val(),
                    "text" : ""
                }, function (result ){
                    $('#proyectoBox').empty();
                    $('#proyectoBox').append(result);

                }, "html")
            }  
        }
         

    });

    $('#txtBuscar').on('input', function(){
        //vamos a buascar por medio de un texto más los filtros
        $.post("../controlador/get_project-filter.php", {
                    "userID" : $('#userID').val(),
                    "grado" : $('#gradoB').val(),
                    "materias" : $('#materiaB').val(),
                    "text" : $(this).val()
                }, function (result ){
                    $('#proyectoBox').empty();
                    $('#proyectoBox').append(result);

                }, "html") 
    })


}