(function(){
    "use strict";

    /* ESCUCHA A LA PAGINA PARA INICIAR EL DOM */
    document.addEventListener('DOMContentLoaded', function(){

        /* -------------------------------------------------------------------------- */
        /*                             JS DEL LEAFLET MAPA                            */
        /* -------------------------------------------------------------------------- */
        var map = L.map('mapa').setView([-6.485751, -76.378917], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([-6.485751, -76.378917]).addTo(map)
            .bindPopup('UXandWD Conference.<br> Voletos ya disponibles.')
            .openPopup();
            // Esto en caso quieras que aparesca como un hover al pin del mapa, quitas el punto y coma de arriba
            /* .bindTooltip('Universidad Nacional de San Martín')
            .openTooltip(); */

    });
})();