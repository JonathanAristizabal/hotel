// JavaScript para mostrar y ocultar módulos
const facturacionLink = document.getElementById("facturacion-link");
const habitacionesLink = document.getElementById("habitaciones-link");
const huespedesLink = document.getElementById("huespedes-link");
const pedidosLink = document.getElementById("pedidos-link");
const usuariosLink = document.getElementById("usuarios-link");
const configuracionLink = document.getElementById("configuracion-link");
const consultarLink = document.getElementById("consultar-link");

facturacionLink.addEventListener("click", mostrarFacturacion);
habitacionesLink.addEventListener("click", mostrarHabitaciones);
huespedesLink.addEventListener("click", mostrarHuespedes);
pedidosLink.addEventListener("click", mostrarPedidos);
usuariosLink.addEventListener("click", mostrarUsuarios);
configuracionLink.addEventListener("click", mostrarConfiguracion);
consultarLink.addEventListener("click", mostrarConsultar);

function mostrarFacturacion(event) {
  event.preventDefault();
  ocultarModulos();
  const moduloFacturacion = document.getElementById("facturacion");
  moduloFacturacion.style.display = "block";
}

function mostrarHabitaciones(event) {
  event.preventDefault();
  ocultarModulos();
  const moduloHabitaciones = document.getElementById("habitaciones");
  moduloHabitaciones.style.display = "block";
}

function mostrarHuespedes(event) {
  event.preventDefault();
  ocultarModulos();
  const moduloHuespedes = document.getElementById("huespedes");
  moduloHuespedes.style.display = "block";
}

function mostrarPedidos(event) {
  event.preventDefault();
  ocultarModulos();
  const moduloPedidos = document.getElementById("pedidos");
  moduloPedidos.style.display = "block";
}

function mostrarUsuarios(event) {
  event.preventDefault();
  ocultarModulos();
  const moduloUsuarios = document.getElementById("usuarios");
  moduloUsuarios.style.display = "block";
}

function mostrarConfiguracion(event) {
  event.preventDefault();
  ocultarModulos();
  const moduloConfiguracion = document.getElementById("configuracion");
  moduloConfiguracion.style.display = "block";
}

function mostrarConsultar(event) {
  event.preventDefault();
  ocultarModulos();
  const moduloConsultar = document.getElementById("consultar");
  moduloConsultar.style.display = "block";
}

function ocultarModulos() {
  const modulos = document.querySelectorAll(".modulo");
  modulos.forEach((modulo) => {
    modulo.style.display = "none";
  });
}

ocultarModulos();

//mostrar y ocultar la ventana modal cuando se hace clic en el botón
// Obtener elementos
const btnCrearHabitacion = document.getElementById("btnCrearHabitacion");
const modalCrearHabitacion = document.getElementById("modalCrearHabitacion");
const formularioCrearHabitacion = document.getElementById(
  "formularioCrearHabitacion"
);

// Evento clic en el botón "Crear nueva Habitación"
btnCrearHabitacion.addEventListener("click", () => {
  modalCrearHabitacion.style.display = "block";
});

// Cerrar la ventana modal al hacer clic fuera del contenido
modalCrearHabitacion.addEventListener("click", (event) => {
  if (event.target === modalCrearHabitacion) {
    modalCrearHabitacion.style.display = "none";
  }
});

// Evento clic en el botón "Crear nueva Habitación"
btnCrearUsuario.addEventListener("click", () => {
  window.location.href = "../pages/crear_cuenta.php";
});

// Evitar que el clic dentro del formulario cierre la ventana modal
formularioCrearHabitacion.addEventListener("click", (event) => {
  event.stopPropagation();
});

// Evento clic en el botón "Crear nueva Habitación"
btnHacerReservacion.addEventListener("click", () => {
  window.location.href = "crear_reserva.php";
});
