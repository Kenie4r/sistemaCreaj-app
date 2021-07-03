$("document").ready(
    function(){
        var slcUsuarios = $("#sctUsuarios");
        var optionUsuarios = $("#optUsuarios");
        var cerrarMenu = $("#exitMR");
        var menu = $("#menu");
        var contenedor = $("#contenedor-principal");
        
        menu.animate(
            {
                left: "-50%"
            }, 1000, "linear"
        );
        cerrarMenu.html("m");

        optionUsuarios.hide();

        slcUsuarios.on("click",
        
            function(){

                if(slcUsuarios.hasClass("inactivo")){
                    optionUsuarios.slideDown("slow");
                    slcUsuarios.removeClass("inactivo");
                    slcUsuarios.addClass("activo");
                }else{
                    optionUsuarios.slideUp("slow");
                    slcUsuarios.removeClass("activo");
                    slcUsuarios.addClass("inactivo");
                }
            }

        );

        cerrarMenu.on("click",
            function(){
                if(cerrarMenu.html() == "m"){
                    menu.animate(
                        {
                            left: 0
                        }, 1000, "linear"
                    );
                    cerrarMenu.html("x");
                    contenedor.addClass("filter blur-sm");
                }else{
                    menu.animate(
                        {
                            left: "-50%"
                        }, 1000, "linear"
                    );
                    cerrarMenu.html("m");
                    contenedor.removeClass("filter blur-sm");
                }
            }
        );
        
    }
)