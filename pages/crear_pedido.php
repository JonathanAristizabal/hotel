<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documento = $_POST['documento'];
    $descripcion = $_POST['descripcion'];
    $valor = $_POST['valor'];

    // Consulta SQL para obtener el ticket y la habitación a partir del documento
    $sql = "SELECT ticket, habitacion FROM huespedes WHERE documento = '$documento'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $ticket = $row['ticket'];
        $habitacion = $row['habitacion'];

        // Consulta SQL para insertar el nuevo pedido en la tabla de pedidos
        $sqlInsertPedido = "INSERT INTO pedidos (documento, descripcion, valor, habitacion)
                            VALUES ('$documento', '$descripcion', '$valor', '$habitacion')";

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
                <li><a href="panel_gestor.php">Regresar</a></li>
            </ul>
        </nav>
    </header>
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