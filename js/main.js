/* -------------------------------------------------------------------------- */
/*                       ESTO ES COMBINACION JQUERY Y JS                      */
/* -------------------------------------------------------------------------- */
$(function(){

    /* LETTERING */
    $('.nombre-sitio').lettering();

    /* ------------------------------------------------------------------------- */
    /*                     SE SEPLIEGA Y CONTRAE EL MENU MOIL                    */
    /* ------------------------------------------------------------------------- */
    $(".menu-movil").on('click', function(){
        if ($(this).children().children().hasClass("fa-bars")) {
            $(this).children().children().removeClass("fa-bars").addClass("fa-times");
            $(this).next().slideDown();
        }else{
            $(this).children().children().removeClass("fa-times").addClass("fa-bars");
            $(this).next().slideUp();
        }
    })

    /* -------------------------------------------------------------------------- */
    /*                         BARRA SUPERIOR DE MENU FIJA                        */
    /* -------------------------------------------------------------------------- */
    // calcula el tamaño de la pantalla actual
    let windowHeight = $(window).height();
    
    // Calcula la altura de el menu
    let alturaMenu = $('.barra').innerHeight();
    
    // Inicia la funcion
    $(window).scroll(function() {
        let scroll = $(window).scrollTop();
        if (scroll > windowHeight) {
            $(".barra").addClass('fixed');
            $('body').css({'margin-top': alturaMenu+'px'});
        }else{
            $(".barra").removeClass('fixed');
            $('body').css({'margin-top':'0px'});
        }
    })

    /* -------------------------------------------------------------------------- */
    /*                              MENU SELECCIONADO                             */
    /* -------------------------------------------------------------------------- */
    var url = window.location.pathname,     
    urlRegExp = new RegExp(url.replace(/\/$/,'') + "$");
    $('.navegador-pricipal a').each(function(){
        if(urlRegExp.test(this.href.replace(/\/$/,''))){
            $('.navegador-pricipal a').removeClass('activo-nav');
            $(this).addClass('activo-nav');
        }
    });

    /* -------------------------------------------------------------------------- */
    /*                        PARA QUE ADMITA SOLO NUMEROS                        */
    /* -------------------------------------------------------------------------- */
    const campoNumerico = document.getElementsByClassName('numerico');
        
    for (var i = 0 ; i < campoNumerico.length; i++){
        let campoNumericou = campoNumerico[i];
        campoNumericou.addEventListener('change', function(){
          if (campoNumericou.value === '') {
              campoNumericou.value = "0";
          }
        })
        
        campoNumericou.addEventListener('keydown', function(evento) {
            const teclaPresionada = evento.key;
            const teclaPresionadaEsUnNumero =
                Number.isInteger(parseInt(teclaPresionada));

            const sePresionoUnaTeclaNoAdmitida = 
                teclaPresionada != 'ArrowDown' &&
                teclaPresionada != 'ArrowUp' &&
                teclaPresionada != 'ArrowLeft' &&
                teclaPresionada != 'ArrowRight' &&
                teclaPresionada != 'Backspace' &&
                teclaPresionada != 'Delete' &&
                teclaPresionada != 'Enter' &&
                !teclaPresionadaEsUnNumero;
            const comienzaPorCero = 
                campoNumericou.value.length === 0 &&
                teclaPresionada == 0;

            if (sePresionoUnaTeclaNoAdmitida || comienzaPorCero) {
                evento.preventDefault(); 
            }

        });
    }
})