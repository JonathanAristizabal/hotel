document.addEventListener("DOMContentLoaded", function () {
  // Función para cargar productos y sus detalles (descripción, precio y stock) según la categoría seleccionada
  function cargarProductosPorCategoria() {
    var categoria = document.getElementById("categoria").value;

    var xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      "get_products_by_category.php?categoria=" + categoria,
      true
    );

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var productos = JSON.parse(xhr.responseText);
        var listaProductos = document.getElementById("lista-productos");
        var descripcionInput = document.getElementById("descripcion");
        var valorInput = document.getElementById("valor");
        var stockProducto = document.getElementById("stock-producto");

        listaProductos.innerHTML = "";
        listaProductos.disabled = false; // Habilitar el campo de productos
        descripcionInput.value = ""; // Limpiar descripción
        valorInput.value = ""; // Limpiar valor
        stockProducto.textContent = ""; // Limpiar stock

        for (var i = 0; i < productos.length; i++) {
          var producto = productos[i];
          var option = document.createElement("option");
          option.value = producto.id_producto;
          option.text = producto.nombre_producto;
          listaProductos.appendChild(option);
        }
      }
    };

    xhr.send();
  }

  // Función para cargar la descripción, el precio y el stock del producto seleccionado
  function cargarDescripcionYPrecio() {
    var productoId = document.getElementById("lista-productos").value;

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_product_details.php?producto_id=" + productoId, true);

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var productoDetails = JSON.parse(xhr.responseText);
        var descripcionInput = document.getElementById("descripcion");
        var valorInput = document.getElementById("valor");
        var stockProducto = document.getElementById("stock-producto");

        descripcionInput.value = productoDetails.descripcion;
        valorInput.value = productoDetails.precio;
        stockProducto.textContent = "Stock: " + productoDetails.stock;
      }
    };

    xhr.send();
  }

  // Agregar un evento para cargar productos cuando cambia la categoría
  var categoriaSelect = document.getElementById("categoria");
  categoriaSelect.addEventListener("change", cargarProductosPorCategoria);

  // Agregar un evento para cargar la descripción, el precio y el stock cuando se selecciona un producto
  var listaProductosSelect = document.getElementById("lista-productos");
  listaProductosSelect.addEventListener("change", cargarDescripcionYPrecio);

  // Llamar la función inicialmente para cargar productos basados en la categoría predeterminada
  cargarProductosPorCategoria();
});
