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
    $diaLlegada = $_POST['dia_llegada'];
    $diaSalida = $_POST['dia_salida'];

    // Generar un token aleatorio corto para el ticket
    $ticket = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);
    // Calcular la cantidad de días reservados
    $timestampLlegada = strtotime($diaLlegada);
    $timestampSalida = strtotime($diaSalida);
    $diferenciaSegundos = $timestampSalida - $timestampLlegada;
    $diasReservados = ceil($diferenciaSegundos / (60 * 60 * 24)); // Convertir segundos a días y redondear hacia arriba

    // Consulta SQL para insertar la nueva reserva en la tabla huespedes
    $sqlInsertReserva = "INSERT INTO huespedes (documento, ticket, dias_reservados, habitacion)
                         VALUES ('$documento', '$ticket', '$dias_reservados', '$habitacion')";

    if ($conn->query($sqlInsertReserva) === true) {
        // Actualizar estado de la habitación a ocupada (estado = 1)
        $sqlUpdateHabitacion = "UPDATE habitaciones SET estado = 1 WHERE numero = '$habitacion'";
        if ($conn->query($sqlUpdateHabitacion) === false) {
            echo "Error al actualizar el estado de la habitación: " . $conn->error;
        }

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
    <link rel="stylesheet" href="../assets/css/reservas.css">

    <title>Crear Reserva</title>
</head>

<body>
    <h1>Crear Nueva Reserva</h1>
    <form action="crear_reserva.php" method="POST">
        <label for="documento">Documento:</label>
        <select id="documento" name="documento">
            <!-- Opciones de documentos -->
        </select>

        <label for="habitacion">Habitación:</label>
        <div>
            <!-- Radio buttons para seleccionar la habitación -->
        </div>

        <label for="dia_llegada">Día de Llegada:</label>
        <input type="date" id="dia_llegada" name="dia_llegada" required>

        <label for="dia_salida">Día de Salida:</label>
        <input type="date" id="dia_salida" name="dia_salida" required>

        <button type="submit">Reservar</button>
    </form>
</body>

</html>