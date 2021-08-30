window.onload = Inicio;
document.getElementById("txt_archivo").addEventListener("change", () =>{
    var fileName = document.getElementById("txt_archivo").Value;
    var idxDot= fileName.lastleerexcel(".") + 1;
    var extFile = fileName.substr(idxDot, FileName.length).tolewerCase();
 
})
function Inicio(){
    var archivo = document.getElementById('txt_archivo').value;
   var formData = new FormData();
   var excel = $("#txt_archivo")[0].files[0];
   formData.append('excel',excel);
   $.ajax({
       url:'leerexcel.php',
       type:'POST',
       data:FormData,
       contentType:false,
       processData:false,
       success:function(resp){
           alert(resp);
       }
   });
   return false;
}