<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];

    // Consulta SQL para obtener los datos del huésped
    $sqlHuesped = "SELECT * FROM huespedes WHERE documento = '$documento'";
    $resultHuesped = $conn->query($sqlHuesped);

    if ($resultHuesped->num_rows == 1) {
        $rowHuesped = $resultHuesped->fetch_assoc();
        $habitacion = $rowHuesped['habitacion'];

        // Eliminar el registro del huésped en la tabla huespedes
        $sqlEliminar = "DELETE FROM huespedes WHERE documento = '$documento'";
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
            echo "Error al eliminar la reserva del huésped: " . $conn->error;
        }
    } else {
        echo "Huésped no encontrado.";
        exit();
    }
} else {
    echo "Documento no proporcionado.";
    exit();
}
?>
