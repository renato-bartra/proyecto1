/* -------------------------------------------------------------------------- */
/*                             ESTO ES PURO JQUERY                            */
/* -------------------------------------------------------------------------- */
$(function(){

    /* -------------------------------------------------------------------------- */
    /*                        TABS DE PROGRACION DEL EVENTO                       */
    /* -------------------------------------------------------------------------- */
    $('.programa-evento .info-curso:first').show();
    $('.menu-programa a:first').addClass("activo");
    $('.menu-programa a').on('click', function(){
        $('.menu-programa a').removeClass("activo");
        $(this).addClass("activo");
        $('.ocultar').hide();
        let enlace = $(this).attr("href");
        $(enlace).fadeIn(500);
        
        // Esto es para que no haga un brinco al dar click
        return false
    })
    
})