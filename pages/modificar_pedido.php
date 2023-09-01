<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['ticket'])) {
    $ticket = $_GET['ticket'];

    // Consulta SQL para obtener los datos del pedido por ticket
    $sql = "SELECT * FROM pedidos WHERE ticket = '$ticket'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $documento = $row['documento'];
            $descripcion = $row['descripcion'];
            $valor = $row['valor'];
            $habitacion = $row['habitacion'];
        } else {
            echo "No se encontró ningún pedido con el ticket proporcionado.";
        }
    } else {
        echo "Error en la consulta: " . $conn->error;
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['documento'], $_POST['ticket'], $_POST['descripcion'], $_POST['valor'])) {
    $documento = $_POST['documento'];
    $ticket = $_POST['ticket'];
    $descripcion = $_POST['descripcion'];
    $valor = $_POST['valor'];

    // Consulta SQL para actualizar la descripción y el valor del pedido
    $sql = "UPDATE pedidos SET descripcion = '$descripcion', valor = '$valor' WHERE documento = '$documento' AND ticket = '$ticket'";

    if ($conn->query($sql) === true) {
        echo '<script>
        alert("Modificación exitosa. Serás redirigido al home");
        window.location.href = "panel_gestor.php"; 
     </script>';
        exit();
    } else {
        echo "Error al actualizar el pedido: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar cuenta de usuario</title>
    <link rel="stylesheet" href="../assets/css/modificar_pedido.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
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

    <div class="contenedor-formulario">
        <h1>Modificar Pedido</h1>
        <form action="modificar_pedido.php" method="POST">
            <label for="documento">Documento:</label>
            <input type="text" name="documento" value="<?php echo htmlspecialchars($documento); ?>" readonly>
            <label for="ticket">Ticket:</label>
            <input type="text" name="ticket" value="<?php echo htmlspecialchars($ticket); ?>" readonly>
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" value="<?php echo htmlspecialchars($descripcion); ?>"><br>
            <label for="valor">Valor:</label>
            <input type="text" name="valor" value="<?php echo htmlspecialchars($valor); ?>"><br>
            <label for="habitacion">Número Habitación:</label>
            <input type="text" name="habitacion" value="<?php echo htmlspecialchars($habitacion); ?>" readonly>
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
    <!-- Aquí puedes mostrar la tabla con los valores actuales -->
</body>

</html>
