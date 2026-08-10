(function () {
    'use strict';

    var chips = document.querySelectorAll('.vt-careers-chip[data-dificultad]');
    var busqueda = document.getElementById('carrerasBusqueda');
    var tarjetas = document.querySelectorAll('.vt-careers-page article[data-dificultad]');

    function aplicarFiltros() {
        var chipActivo = document.querySelector('.vt-careers-chip[data-dificultad].is-active');
        var dificultad = chipActivo ? chipActivo.dataset.dificultad : 'Todas';
        var termino = (busqueda.value || '').trim().toLowerCase();

        tarjetas.forEach(function (card) {
            var coincideDificultad = dificultad === 'Todas' || card.dataset.dificultad === dificultad;
            var coincideNombre = termino === '' || card.dataset.nombre.toLowerCase().indexOf(termino) !== -1;
            card.style.display = coincideDificultad && coincideNombre ? '' : 'none';
        });
    }

    chips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            chips.forEach(function (c) {
                c.classList.remove('is-active');
            });
            chip.classList.add('is-active');
            aplicarFiltros();
        });
    });

    if (busqueda) {
        busqueda.addEventListener('input', aplicarFiltros);
    }
})();