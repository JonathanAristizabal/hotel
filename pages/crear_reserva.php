<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

// Obtener la lista de documentos de usuarios
$sqlDocumentos = "SELECT documento FROM usuarios";
$resultDocumentos = $conn->query($sqlDocumentos);

// Obtener la lista de habitaciones disponibles
$sqlHabitacionesDisponibles = "SELECT numero, tipo, valor_diario FROM habitaciones WHERE estado = 0";
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
    $fechaLlegada = new DateTime($diaLlegada);
    $fechaSalida = new DateTime($diaSalida);
    $intervalo = $fechaLlegada->diff($fechaSalida);
    $diasReservados = $intervalo->days;


    // Consulta SQL para insertar la nueva reserva en la tabla huespedes
    $sqlInsertReserva = "INSERT INTO huespedes (documento, ticket, habitacion, fecha_checkIN, fecha_checkOUT, dias_reservados)
                         VALUES ('$documento', '$ticket', '$habitacion', '$diaLlegada', '$diaSalida', '$diasReservados')";

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
    <link rel="stylesheet" href="../assets/css/crear_reserva.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">

    <title>Crear Reserva</title>
</head>

<body>
    <div class="container">
        <header>
            <div id="logo">
                <img src="../assets/img/logoclaro.png" alt="Logo del Hotel" width="135px" height="70px">
            </div>
            <nav>
                <ul class="ul-encabezados">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="panel_gestor.php">Regresar</a></li>
                </ul>
            </nav>
        </header>
    </div>
    <br>
    <h1>Crear Nueva Reserva</h1>
    <form action="crear_reserva.php" method="POST">
        <label for="documento">Documento:</label>
        <select id="documento" name="documento" required>
            <?php
            while ($rowDocumento = $resultDocumentos->fetch_assoc()) {
                echo '<option value="' . $rowDocumento['documento'] . '">' . $rowDocumento['documento'] . '</option>';
            }
            ?>
        </select>
        <br>
        <label for="habitacion">Habitación:</label>
        <br>
        <br>
        <div>
            <?php
            while ($rowHabitacion = $resultHabitacionesDisponibles->fetch_assoc()) {
                echo '<label>';
                echo '<input type="radio" name="habitacion" value="' . $rowHabitacion['numero'] . '" required>';
                echo ' Habitación ' . $rowHabitacion['numero'] . ' - ' . $rowHabitacion['tipo'] . ' ($' . $rowHabitacion['valor_diario'] . ' diario)';
                echo '</label><br>';
            }
            ?>
        </div>
        <br>
        <label for="dia_llegada">Día de Llegada:</label>
        <input type="date" id="dia_llegada" name="dia_llegada" required>

        <label for="dia_salida">Día de Salida:</label>
        <input type="date" id="dia_salida" name="dia_salida" required>
        <br>
        <br>
        <button type="submit">Reservar</button>
    </form>
</body>

</html>