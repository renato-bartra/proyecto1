/* -------------------------------------------------------------------------- */
/*                             ESTO ES PURO JQUERY                            */
/* -------------------------------------------------------------------------- */
$(function(){

    $('.nombre-sitio').lettering();

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

    /* -------------------------------------------------------------------------- */
    /*                        ANIMACIONES PARA LOS NUMEROS                        */
    /* -------------------------------------------------------------------------- */

    // Animacion de numeros
    $('.resumen-evento-anmt div:nth-child(1) p').animateNumber({number: 6}, 1200);
    $('.resumen-evento-anmt div:nth-child(2) p').animateNumber({number: 15}, 1200);
    $('.resumen-evento-anmt div:nth-child(3) p').animateNumber({number: 3}, 1500);
    $('.resumen-evento-anmt div:nth-child(4) p').animateNumber({number: 9}, 1500);

    // Cuenta regresiva
    $('.cuenta-regresiva').countdown('2020/07/20 09:00:00', function(event){
        $('#dias').html(event.strftime('%D'));
        $('#horas').html(event.strftime('%H'));
        $('#minutos').html(event.strftime('%M'));
        $('#segundos').html(event.strftime('%S'));
    })
})