(function () {
    'use strict';

    var chips = document.querySelectorAll('.vt-careers-chip[data-area]');
    var busqueda = document.getElementById('carrerasBusqueda');
    var tarjetas = document.querySelectorAll('.vt-careers-page article[data-area]');
    var carrusel = document.getElementById('areaCarrusel');
    var botonAnterior = document.getElementById('carruselAnterior');
    var botonSiguiente = document.getElementById('carruselSiguiente');

    function aplicarFiltros() {
        var chipActivo = document.querySelector('.vt-careers-chip[data-area].is-active');
        var area = chipActivo ? Number(chipActivo.dataset.area) : 0;
        var termino = (busqueda.value || '').trim().toLowerCase();

        tarjetas.forEach(function (card) {
            var coincideArea = area === 0 || Number(card.dataset.area) === area;
            var coincideNombre = termino === '' || card.dataset.nombre.toLowerCase().indexOf(termino) !== -1;
            card.style.display = coincideArea && coincideNombre ? '' : 'none';
        });
    }

    chips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            chips.forEach(function (c) {
                c.classList.remove('is-active');
            });
            chip.classList.add('is-active');
            if (carrusel) {
                chip.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
            }
            aplicarFiltros();
        });
    });

    if (busqueda) {
        busqueda.addEventListener('input', aplicarFiltros);
    }

    function desplazarCarrusel(cantidad) {
        if (carrusel) {
            carrusel.scrollBy({ left: cantidad, behavior: 'smooth' });
        }
    }

    if (botonAnterior) {
        botonAnterior.addEventListener('click', function () {
            desplazarCarrusel(-280);
        });
    }

    if (botonSiguiente) {
        botonSiguiente.addEventListener('click', function () {
            desplazarCarrusel(280);
        });
    }

    var parametros = new URLSearchParams(window.location.search);
    var areaUrl = Number(parametros.get('area') || 0);
    if (areaUrl > 0) {
        var chipUrl = Array.prototype.find.call(chips, function (c) {
            return Number(c.dataset.area) === areaUrl;
        });
        if (chipUrl) {
            chips.forEach(function (c) {
                c.classList.remove('is-active');
            });
            chipUrl.classList.add('is-active');
        }
    }
})();