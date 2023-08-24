<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

if (isset($_GET['numero'])) {
    $numeroHabitacion = $_GET['numero'];

    // Consulta SQL para obtener los datos de la habitación por su número
    $sql = "SELECT * FROM habitaciones WHERE numero = '$numeroHabitacion'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $tipo = $row['tipo'];
        $descripcion = $row['descripcion'];
        $valor_diario = $row['valor_diario'];
    } else {
        echo "Habitación no encontrada.";
        exit();
    }
} else {
    echo "Número de habitación no proporcionado.";
    exit();
}

// Cuando se envíe el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevoTipo = $_POST['tipo'];
    $nuevaDescripcion = $_POST['descripcion'];
    $nuevoValorDiario = $_POST['valor_diario'];

    // Consulta SQL para actualizar los datos de la habitación
    $sqlUpdate = "UPDATE habitaciones SET tipo = '$nuevoTipo', descripcion = '$nuevaDescripcion', valor_diario = '$nuevoValorDiario' WHERE numero = '$numeroHabitacion'";

    if ($conn->query($sqlUpdate) === true) {
        echo '<script>
                        alert("Modificación exitosa. Serás redirigido al home");
                        window.location.href = "panel_gestor.php"; 
                     </script>';
    } else {
        echo "Error al modificar la habitación: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modificar Habitación</title>
</head>

<body>
    <h2>Modificar Habitación</h2>
    <form method="post">

        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="<?php echo $tipo; ?>">Individual</option>
            <option value="Individual">Individual</option>
            <option value="Doble">Doble</option>
            <option value="Suite">Suite</option>
        </select>
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" required><br>

        <label for="valor_diario">Valor Diario:</label>
        <input type="number" id="valor_diario" name="valor_diario" value="<?php echo $valor_diario; ?>" required><br>

        <button type="submit">Modificar</button>
    </form>
</body>

</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>