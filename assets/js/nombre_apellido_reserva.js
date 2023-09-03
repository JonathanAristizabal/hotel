// Obtener una referencia al elemento de entrada de número de documento
var documentoInput = document.getElementById('documento');
var nombreClienteSpan = document.getElementById('nombreCliente');
var apellidoClienteSpan = document.getElementById('apellidoCliente');

// Agregar un evento 'input' al campo de número de documento
documentoInput.addEventListener('input', function () {
  var documento = documentoInput.value;

  // Verificar si el campo de número de documento no está vacío
  if (documento.trim() !== '') {
    // Realizar una solicitud AJAX para obtener el nombre y apellido del cliente
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var data = JSON.parse(xhr.responseText);
        if (data) {
          // Mostrar el nombre y apellido del cliente
          nombreClienteSpan.textContent = data.nombre;
          apellidoClienteSpan.textContent = data.apellido;
        }
      }
    };
    xhr.open('GET', 'obtener_nombre_apellido.php?documento=' + documento, true); // Modifica la URL para que apunte a obtener_nombre_apellido.php
    xhr.send();
  } else {
    // Limpiar los campos de nombre y apellido si el campo de número de documento está vacío
    nombreClienteSpan.textContent = '';
    apellidoClienteSpan.textContent = '';
  }
});
