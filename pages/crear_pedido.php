<?php
include '../conections/conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documento = $_POST['documento'];
    $descripcion = $_POST['descripcion'];
    $valor = $_POST['valor'];
    $cantidad = $_POST['cantidad']; // Nuevo campo de cantidad de productos

    $categoria = $_POST['categoria'];
    $producto_id = $_POST['lista-productos'];

    // Obtener el stock del producto seleccionado
    $stock = obtenerStockProducto($producto_id);

    if ($stock !== false) {
        // Consulta SQL para obtener el ticket y la habitación a partir del documento
        $sql = "SELECT ticket, habitacion FROM huespedes WHERE documento = '$documento'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $ticket = $row['ticket'];
            $habitacion = $row['habitacion'];

            // Consulta SQL para insertar el nuevo pedido en la tabla de pedidos
            $sqlInsertPedido = "INSERT INTO pedidos (documento, ticket, descripcion, valor, habitacion, producto_id, stock, cantidad)
                                VALUES ('$documento', '$ticket', '$descripcion', '$valor', '$habitacion', '$producto_id', '$stock', '$cantidad')";

            if ($conn->query($sqlInsertPedido) === true) {
                echo '<script>
                        alert("Pedido creado con éxito.");
                     </script>';
            } else {
                echo "Error al crear el pedido: " . $conn->error;
            }
        } else {
            echo "Huésped no encontrado.";
        }
    } else {
        echo "Error al obtener el stock del producto.";
    }
}

// Función para obtener el stock de un producto por su ID
function obtenerStockProducto($producto_id) {
    global $conn;
    $sqlStock = "SELECT stock FROM productos WHERE id = '$producto_id'";
    $resultStock = $conn->query($sqlStock);

    if ($resultStock->num_rows == 1) {
        $rowStock = $resultStock->fetch_assoc();
        return $rowStock['stock'];
    } else {
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/crear_pedido.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <title>Crear Nuevo Pedido</title>
</head>

<body>
    <header>
        <div id="logo">
            <img src="../assets/img/logoclaro.png" alt="Logo del Hotel" width="135px" height="70px">
        </div>
        <nav>
            <ul class="ul-encabezados">
                <a href="panel_gestor.php">Regresar</a>
            </ul>
        </nav>
    </header>
    <h2>Crear Nuevo Pedido</h2>
    <form action="" method="POST">
        <label for="documento">Documento y Ticket:</label>
        <select id="documento" name="documento" required>
            <?php
            $sqlDocumentosTickets = "SELECT documento, ticket FROM huespedes";
            $resultDocumentosTickets = $conn->query($sqlDocumentosTickets);

            while ($rowDocumentoTicket = $resultDocumentosTickets->fetch_assoc()) {
                echo '<option value="' . $rowDocumentoTicket['documento'] . '">'
                    . $rowDocumentoTicket['documento'] . ' - Ticket: ' . $rowDocumentoTicket['ticket']
                    . '</option>';
            }
            ?>
        </select>

        <br>
        <label for="categoria">Categoría de Producto:</label>
        <select id="categoria" name="categoria" required>
            <option value="" disabled selected>Seleccione una categoría</option>
            <?php
            $sqlCategorias = "SELECT DISTINCT categoria FROM productos";
            $resultCategorias = $conn->query($sqlCategorias);

            while ($rowCategoria = $resultCategorias->fetch_assoc()) {
                echo '<option value="' . $rowCategoria['categoria'] . '">'
                    . $rowCategoria['categoria'] . '</option>';
            }
            ?>
        </select>

        <br>
        <label for="lista-productos">Productos Disponibles:</label>
        <select id="lista-productos" name="lista-productos" required>
            <option value="" disabled selected>Seleccione un producto</option>
        </select>

        <!-- Mostrar el stock del producto seleccionado -->
        <p id="stock-producto"></p>

        <br>
        <!-- Nuevo campo de cantidad de productos -->
        <label for="cantidad">Cantidad de Productos:</label>
        <input type="number" id="cantidad" name="cantidad" required>

        <br>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50" required></textarea>
        <br>
        <label for="valor">Valor:</label>
        <input type="number" id="valor" name="valor" required>
        <br>
        <button type="submit">Crear Pedido</button>
    </form>
    <script src="../assets/js/crear_pedido.js"></script>
</body>

</html>
