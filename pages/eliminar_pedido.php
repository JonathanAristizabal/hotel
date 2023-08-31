<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['ticket'])) {
    $ticket = $_GET['ticket'];

    $sqlHuespedes = "SELECT documento FROM huespedes WHERE ticket = '$ticket'";
    if ($sqlHuespedes > 1) {
        // Consulta SQL para eliminar la habitación por su número
        $sql = "DELETE FROM pedidos WHERE numero = '$numeroHabitacion'";

        if ($conn->query($sql) === true) {
            // Redireccionar a la página principal o donde consideres apropiado
            header("Location: panel_gestor.php");
            exit();
        } else {
            echo "Error al eliminar la habitación: " . $conn->error;
        }
    }
}
