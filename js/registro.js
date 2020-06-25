/* -------------------------------------------------------------------------- */
/*                           ESTO ES JAVASCRIPT PURO                          */
/* -------------------------------------------------------------------------- */
(function(){
    "use strict";
        
    /* CREAR LA PRIMERA VARIABLE REGALO PARA EL REGISTRO */
    let regalo = document.getElementById('regalo');

    /* -------------------------------------------------------------------------- */
    /*                             PAGINA DE REGISTRO                             */
    /* -------------------------------------------------------------------------- */
    /* ESCUCHA A LA PAGINA PARA INICIAR EL DOM */
    document.addEventListener('DOMContentLoaded', function(){

        /* VARIABLES PARA DATOS DE USUARIO */
        let nombre = document.getElementById('nombre');
        let apellido = document.getElementById('apellido');
        let email = document.getElementById('email');

        /* VARIABLES PARA TTIKETS DE VENTA */
        
        let paseDia = document.getElementById('pase_dia');
        let paseCompleto = document.getElementById('pase_completo');
        let dosDias = document.getElementById('dos_dias');

        /* VARIABLES DE CALCULO Y DIVS */
        let calcular = document.getElementById('calcular');
        let errorDiv = document.getElementById('error');
        let btnRegistro = document.getElementById('btnRegistro');
        let lstProductos = document.getElementById('lista-productos');
        let sumaTotal = document.getElementById('suma-total');

        // DESABILITA EN BOTON PAGAR
        btnRegistro.disabled = true;
        btnRegistro.style.backgroundColor = "#E27769";
        btnRegistro.style.cursor = "default";

        /* EXTRAS */
        let etiquetas = document.getElementById('etiqueta_evento');
        let camisa= document.getElementById('camisa_envento');

        /* -------------------------------------------------------------------------- */
        /*                      FUNCION DATOS PERSONALE ERRONEOS                      */
        /* -------------------------------------------------------------------------- */
        nombre.addEventListener('blur', errorImput);
        apellido.addEventListener('blur', errorImput);
        email.addEventListener('blur', errorImput);
        email.addEventListener('blur', validarEmail);

        /* FUNCION VALIDAR INPUT */
        function errorImput(){
        
            errorDiv.style.display = 'none';
            
            if (this.value === '') {
                errorDiv.style.display = 'block';
                errorDiv.style.fontSize = "1.7rem";
                errorDiv.innerHTML = 'Este campo es obligatorio';
                errorDiv.style.border = "1px solid red";
                errorDiv.style.backgroundColor = "#F34918";
                errorDiv.style.color = "#FFFFFF";
            }else{
                errorDiv.style.display = 'none';
            }
        }

        /* FUNCION VALIDAR EMAIL */
        function validarEmail(){
            let campo = event.target;
            let emailV = email.value;

            var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            var regOficial = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

            //Se muestra un texto a modo de ejemplo, luego va a ser un icono
            if (reg.test(campo.value) && regOficial.test(campo.value)) {
                errorDiv.style.display = 'none';

                let validarEmail = new FormData();
                validarEmail.append('validarEmail', emailV);
                
                fetch("../includes/funciones/funciones.php", {
                    method: 'POST',
                    body: validarEmail
                })
                .then(res => res.json())
                .then(datos => {
                    if (datos) {
                        errorDiv.style.display = 'block';
                        errorDiv.style.fontSize = "1.7rem";
                        errorDiv.innerHTML = 'El email ya fue registrado';
                        errorDiv.style.border = "1px solid red";
                        errorDiv.style.backgroundColor = "#F34918";
                        errorDiv.style.color = "#FFFFFF";
                        email.value = "";
                    }
                })
                .catch(function(error) {
                    console.log('Request failed', error)
                  });
                
            } else {
                errorDiv.style.display = 'block';
                errorDiv.style.fontSize = "1.7rem";
                errorDiv.innerHTML = 'El formato de email es incorrecto';
                errorDiv.style.border = "1px solid red";
                errorDiv.style.backgroundColor = "#F34918";
                errorDiv.style.color = "#FFFFFF";
            }

            
        }
        
        /* -------------------------------------------------------------------------- */
        /*                      FUNCION AL DAR CLICK EN CALCULAR                      */
        /* -------------------------------------------------------------------------- */
        calcular.addEventListener('click', function(){

            /* VALIDA LA ENTRADA DEL REGALO Y QUE TENGA ALMENO UNA PASE */
            if (regalo.value != '') {
                if (paseDia.value === "0" && paseCompleto.value === "0" && dosDias.value === "0" &&
                    paseDia.value === "" && paseCompleto.value === "" && dosDias.value === "") {
                    alert("Debes elegir almenos un pase de entrada");
                    return;
                }else{
                    var montoT = (parseInt(paseDia.value * 30) || 0) + (parseInt(paseCompleto.value * 50) || 0) + (parseInt(dosDias.value * 45) || 0) + (parseInt(etiquetas.value * 2) || 0) + (Number((camisa.value * 10) * 0.93) || 0);
                }
            }else{
                alert("Debes elegir un regalo");
                return;
            }

            /* GENERA EL LISTADO DE PRODUCTOS */
            let listadoProduct = [];
            if (paseDia.value != '0' && paseDia.value != '') {
                listadoProduct.push(parseInt(paseDia.value) + " Pases por día");
            }
            if (dosDias.value != '0' && dosDias.value != '') {
                listadoProduct.push(parseInt(dosDias.value) + " Pases por 2 días");
            }
            if (paseCompleto.value != '0' && paseCompleto.value != '') {
                listadoProduct.push(parseInt(paseCompleto.value) + " Pases completos");
            }
            if (camisa.value != '0' && camisa.value != '') {
                listadoProduct.push(parseInt(camisa.value) + " Camisas");
            }
            if (etiquetas.value != '0' && etiquetas.value != '') {
                listadoProduct.push(parseInt(etiquetas.value) + " Paquete de etiquetas");
            }
            listadoProduct.push(regalo.options[regalo.selectedIndex].innerHTML + " de regalo")

            /* IMPRIME EL LISTADO EN PANTALLA */
            lstProductos.style.display = "block";
            lstProductos.innerHTML = '';
            for (let i = 0; i < listadoProduct.length; i++) {
                lstProductos.innerHTML += `<p style="font-size:1.3rem; margin: 1rem 0rem">${listadoProduct[i]}</p>`;
            }

            sumaTotal.innerHTML = `<p>$ ${montoT.toFixed(2)}</p>`;

            // Abilita el boton pagar
            btnRegistro.disabled = false;
            btnRegistro.style.backgroundColor = "#FE4918";
            btnRegistro.style.cursor = "pointer";
            document.getElementById('total_pedido').value = montoT.toFixed(2);
            
        });

        /* -------------------------------------------------------------------------- */
        /*                    FUNCION AL DAR CLICK EN PASE POR DIA                    */
        /* -------------------------------------------------------------------------- */
        paseDia.addEventListener('blur', mostrarDias);
        dosDias.addEventListener('blur', mostrarDias);
        paseCompleto.addEventListener('blur', mostrarDias);

        /* FUNCION GENERAL */
        function mostrarDias(){
            let boletoDia = parseInt(paseDia.value),
                boleto2ias = parseInt(dosDias.value),
                boletoCompleto = parseInt(paseCompleto.value),
                pasesElegidos = [];
            
            /* FORMATEA LOS CAMPOS A MOSTRAR */
            document.getElementById('viernes').style.display = 'none';
            document.getElementById('sabado').style.display = 'none';
            document.getElementById('domingo').style.display = 'none';

            /* RECOGE EL PASE SELECCIONADO Y CREA UN ARRAY */
            if (boletoDia > 0) {
                pasesElegidos.push('viernes');
            }
            if (boleto2ias > 0) {
                pasesElegidos.push('viernes', 'sabado');
            }
            if (boletoCompleto > 0) {
                pasesElegidos.push('viernes', 'sabado', 'domingo');
            }

            /* EL ARRAY CONTIENE LOS ID DE CADA SECCION A MOSTRAR */
            pasesElegidos.forEach(pases => {
                document.getElementById(pases).style.display = 'block';
            });
        }

    });
})();