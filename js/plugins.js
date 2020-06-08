// Avoid `console` errors in browsers that lack a console.
(function() {
  var method;
  var noop = function () {};
  var methods = [
    'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
    'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
    'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
    'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
  ];
  var length = methods.length;
  var console = (window.console = window.console || {});

  while (length--) {
    method = methods[length];

    // Only stub undefined methods.
    if (!console[method]) {
      console[method] = noop;
    }
  }
}());

// Place any jQuery/helper plugins in here.

(function(){
  "use strict";

    document.addEventListener('DOMContentLoaded', function(){

        /* PARA QUE ADMITA SOLO NUMEROS */
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
    });
})();
