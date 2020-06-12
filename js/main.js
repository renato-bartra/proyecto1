/* -------------------------------------------------------------------------- */
/*                       ESTO ES COMBINACION JQUERY Y JS                      */
/* -------------------------------------------------------------------------- */
$(function(){

    /* -------------------------------------------------------------------------- */
    /*                          SE SEPLIEGA EL MENU MOIL                          */
    /* -------------------------------------------------------------------------- */
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