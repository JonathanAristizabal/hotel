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
<html>

<head>
    <title>Modificar Pedido</title>
</head>

<body>
    <h1>Modificar Pedido</h1>
    <form action="modificar_pedido.php" method="POST">
        <label for="descripcion">Documento:</label>
        <input type="text" name="documento" value="<?php echo $documento; ?>" readonly>
        <label for="descripcion">Ticket:</label>
        <input type="text" name="ticket" value="<?php echo $ticket; ?>" readonly>
        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" value="<?php echo $descripcion; ?>"><br>
        <label for="valor">Valor:</label>
        <input type="text" name="valor" value="<?php echo $valor; ?>"><br>
        <label for="valor">Número Habitación:</label>
        <input type="text" name="habitacion" value="<?php echo $habitacion; ?>" readonly>
        <input type="submit" value="Guardar Cambios">
    </form>
    <!-- Aquí puedes mostrar la tabla con los valores actuales -->
</body>

</html>