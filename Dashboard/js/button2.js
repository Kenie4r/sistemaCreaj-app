
function mostrar(){
    var menu = document.getElementById('mobile-menu');
    if(menu.className== 'hidden'){
        menu.className  = 'block';
    }else{
        menu.className= 'hidden';
    }
}