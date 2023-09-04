// JavaScript para mostrar y ocultar módulos
const facturacionLink = document.getElementById("facturacion-link");
const habitacionesLink = document.getElementById("habitaciones-link");
const huespedesLink = document.getElementById("huespedes-link");
const pedidosLink = document.getElementById("pedidos-link");
const usuariosLink = document.getElementById("usuarios-link");
const configuracionLink = document.getElementById("configuracion-link");
const consultarLink = document.getElementById("consultar-link");
const productosLink = document.getElementById("productos-link");

facturacionLink.addEventListener("click", mostrarFacturacion);
habitacionesLink.addEventListener("click", mostrarHabitaciones);
huespedesLink.addEventListener("click", mostrarHuespedes);
pedidosLink.addEventListener("click", mostrarPedidos);
usuariosLink.addEventListener("click", mostrarUsuarios);
configuracionLink.addEventListener("click", mostrarConfiguracion);
consultarLink.addEventListener("click", mostrarConsultar);
productosLink.addEventListener("click", mostrarProductos);

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

function mostrarProductos(event) {
  event.preventDefault();
  ocultarModulos();
  const moduloProductos = document.getElementById("productos");
  moduloProductos.style.display = "block";
}


function ocultarModulos() {
  const modulos = document.querySelectorAll(".modulo");
  modulos.forEach((modulo) => {
    modulo.style.display = "none";
  });
}

ocultarModulos();

document.addEventListener("DOMContentLoaded", function () {
  const btnCrearUsuario = document.getElementById("btnCrearUsuario");
  const btnCrearPedido = document.getElementById("btnCrearPedido");
  const btnCrearHabitacion = document.getElementById("btnCrearHabitacion");
  const btnCrearProducto = document.getElementById("btnCrearProducto");
  if (btnCrearUsuario) {
    btnCrearUsuario.addEventListener("click", function () {
      window.location.href = "crear_cuenta.php";
    });
  }
  if (btnCrearPedido) {
    btnCrearPedido.addEventListener("click", function () {
      window.location.href = "crear_pedido.php";
    });
  }
  if (btnCrearHabitacion) {
    btnCrearHabitacion.addEventListener("click", function () {
      window.location.href = "crear_habitacion.php";
    });
  }

  if (btnCrearProducto) {
    btnCrearProducto.addEventListener("click", function () {
      window.location.href = "crear_producto.php";
    });
  }  
});
