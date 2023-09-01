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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/modificar_habitacion.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <title>Modificar_habitacion</title>
</head>
<body>
    <!-- encabezado -->
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
    <br>
    <section></section>
    <h2>Modificar Habitación</h2>
    <div>
        <form method="post">
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="Individual" <?php if ($tipo === 'Individual') echo 'selected'; ?>>Individual</option>
                <option value="Doble" <?php if ($tipo === 'Doble') echo 'selected'; ?>>Doble</option>
                <option value="Suite" <?php if ($tipo === 'Suite') echo 'selected'; ?>>Suite</option>
            </select>
            <br>
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" required>
            <br>
            <label for="valor_diario">Valor Diario:</label>
            <input type="number" id="valor_diario" name="valor_diario" value="<?php echo $valor_diario; ?>" required>
            <br>
            <br>
            <button type="submit">Modificar</button>
        </form>
    </div>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>