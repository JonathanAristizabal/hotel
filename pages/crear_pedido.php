<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documentoTicket = $_POST['documento'];
    $descripcion = $_POST['descripcion'];
    $valor = $_POST['valor'];

    // Obtener el número de habitación a partir del documento y ticket
    $sqlHabitacion = "SELECT habitacion FROM huespedes WHERE documento = '$documentoTicket' AND ticket = '$ticket'";
    $resultHabitacion = $conn->query($sqlHabitacion);

    if ($resultHabitacion->num_rows == 1) {
        $rowHabitacion = $resultHabitacion->fetch_assoc();
        $habitacion = $rowHabitacion['habitacion'];

        // Consulta SQL para insertar el nuevo pedido en la tabla de pedidos
        $sqlInsertPedido = "INSERT INTO pedidos (documento, descripcion, valor, habitacion)
                            VALUES ('$documentoTicket', '$descripcion', '$valor', '$habitacion')";

        if ($conn->query($sqlInsertPedido) === true) {
            echo '<script>
                    alert("Pedido creado con éxito.");
                    // Puedes redirigir a una página de confirmación o hacer alguna otra acción
                 </script>';
        } else {
            echo "Error al crear el pedido: " . $conn->error;
        }
    } else {
        echo "No se encontró el huésped correspondiente al documento y ticket.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Pedido</title>
</head>

<body>
    <h1>Crear Nuevo Pedido</h1>
    <form action="" method="POST">
        <label for="documento">Documento y Ticket:</label>
        <select id="documento" name="documento" required>
            <?php
            // Consulta SQL para obtener los documentos y tickets de huéspedes
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
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50" required></textarea>
        <br>
        <label for="valor">Valor:</label>
        <input type="number" id="valor" name="valor" required>
        <br>
        <button type="submit">Crear Pedido</button>
    </form>
</body>

</html>