function mostrarpremio(){
    //document.getElementById('premio').style.display='block';
    if(document.getElementById('premio').style.display=='block'){
        document.getElementById('premio').style.display='none';
    }else{
        document.getElementById('premio').style.display='block';
    }
}
function mostrar(){
    var menu = document.getElementById('mobile-menu');
    if(menu.class== 'hidden'){
        menu.class = 'block';
    }else{
        menu.class= 'hidden';
    }
}