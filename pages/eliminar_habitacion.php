<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['numero'])) {
    $numeroHabitacion = $_GET['numero'];

    // Consulta SQL para eliminar la habitación por su número
    $sql = "DELETE FROM habitaciones WHERE numero = '$numeroHabitacion'";

    if ($conn->query($sql) === true) {
        // Redireccionar a la página principal o donde consideres apropiado
        header("Location: panel_gestor.php");
        exit();
    } else {
        echo "Error al eliminar la habitación: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
