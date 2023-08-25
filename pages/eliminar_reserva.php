<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

if (isset($_GET['ticket'])) {
    $ticket = $_GET['ticket'];

    // Consulta SQL para obtener los datos de la reserva
    $sqlReserva = "SELECT * FROM huespedes WHERE ticket = '$ticket'";
    $resultReserva = $conn->query($sqlReserva);

    if ($resultReserva->num_rows == 1) {
        $rowReserva = $resultReserva->fetch_assoc();
        $habitacion = $rowReserva['habitacion'];

        // Eliminar el registro de la reserva en la tabla huespedes
        $sqlEliminar = "DELETE FROM huespedes WHERE ticket = '$ticket'";
        if ($conn->query($sqlEliminar) === true) {
            // Actualizar el estado de la habitación a disponible en la tabla habitaciones
            $sqlActualizarHabitacion = "UPDATE habitaciones SET estado = 0 WHERE numero = '$habitacion'";
            if ($conn->query($sqlActualizarHabitacion) === true) {
                echo '<script>
                        alert("Reserva eliminada con éxito. Habitación disponible nuevamente.");
                        window.location.href = "panel_gestor.php"; 
                     </script>';
            } else {
                echo "Error al actualizar el estado de la habitación: " . $conn->error;
            }
        } else {
            echo "Error al eliminar la reserva: " . $conn->error;
        }
    } else {
        echo "Reserva no encontrada.";
        exit();
    }
} else {
    echo "Ticket de reserva no proporcionado.";
    exit();
}
?>
