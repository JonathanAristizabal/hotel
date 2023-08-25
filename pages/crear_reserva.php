<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

// Obtener la lista de documentos de usuarios
$sqlDocumentos = "SELECT documento FROM usuarios";
$resultDocumentos = $conn->query($sqlDocumentos);

// Obtener la lista de habitaciones disponibles
$sqlHabitacionesDisponibles = "SELECT numero, tipo FROM habitaciones WHERE estado = 0";
$resultHabitacionesDisponibles = $conn->query($sqlHabitacionesDisponibles);

// Cuando se envíe el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documento = $_POST['documento'];
    $habitacion = $_POST['habitacion'];
    $dias_reservados = $_POST['dias_reservados'];

    // Generar un token aleatorio corto para el ticket
    $ticket = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);

    // Consulta SQL para insertar la nueva reserva en la tabla huespedes
    $sqlInsertReserva = "INSERT INTO huespedes (documento, ticket, dias_reservados, habitacion)
                         VALUES ('$documento', '$ticket', '$dias_reservados', '$habitacion')";

    if ($conn->query($sqlInsertReserva) === true) {
        echo '<script>
                alert("Reserva exitosa. Se ha generado el ticket: ' . $ticket . '");
                window.location.href = "reservas.php"; // Cambia "reservas.php" por la URL deseada.
             </script>';
    } else {
        echo "Error al realizar la reserva: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Reserva</title>
</head>
<body>
    <h1>Crear Nueva Reserva</h1>
    <form method="POST">
        <label for="documento">Documento:</label>
        <select id="documento" name="documento" required>
            <?php
            while ($rowDocumento = $resultDocumentos->fetch_assoc()) {
                echo '<option value="' . $rowDocumento['documento'] . '">' . $rowDocumento['documento'] . '</option>';
            }
            ?>
        </select><br>

        <label>Seleccione una habitación disponible:</label><br>
        <?php
        while ($rowHabitacion = $resultHabitacionesDisponibles->fetch_assoc()) {
            echo '<input type="radio" name="habitacion" value="' . $rowHabitacion['numero'] . '">';
            echo $rowHabitacion['tipo'] . ' (Habitación ' . $rowHabitacion['numero'] . ')<br>';
        }
        ?>

        <label for="dias_reservados">Días a reservar:</label>
        <input type="number" id="dias_reservados" name="dias_reservados" required><br>

        <button type="submit">Reservar</button>
    </form>
</body>
</html>
