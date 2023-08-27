// Obtén una referencia al elemento de filtro
const filtroTipo = document.getElementById('filtroTipo');

// Obtén una referencia a todas las filas de la tabla
const filas = document.querySelectorAll('tbody tr');

// Agrega un evento de cambio al elemento de filtro
filtroTipo.addEventListener('change', () => {
    const tipoSeleccionado = filtroTipo.value.toLowerCase();

    // Recorre todas las filas y muestra u oculta según el tipo seleccionado
    filas.forEach((fila) => {
        const tipoHabitacion = fila.querySelector('td:nth-child(7)').textContent.toLowerCase();

        if (tipoSeleccionado === '' || tipoHabitacion === tipoSeleccionado) {
            fila.style.display = 'table-row';
        } else {
            fila.style.display = 'none';
        }
    });
});
