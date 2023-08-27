<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

if (isset($_GET['ticket'])) {
    $ticket = $_GET['ticket'];

    // Consulta SQL para obtener los datos del huésped por el ticket
    $sqlHuesped = "SELECT h.*, t.tipo, t.valor_diario FROM huespedes h
                   JOIN habitaciones t ON h.habitacion = t.numero
                   WHERE h.ticket = '$ticket'";
    $resultHuesped = $conn->query($sqlHuesped);

    if ($resultHuesped->num_rows == 1) {
        $rowHuesped = $resultHuesped->fetch_assoc();
        $habitacion = $rowHuesped['habitacion'];
    } else {
        echo "Huésped no encontrado.";
        exit();
    }
} else {
    echo "Ticket no proporcionado.";
    exit();
}

// Cuando se envíe el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevaFechaLlegada = $_POST['nueva_fecha_llegada'];
    $nuevaFechaSalida = $_POST['nueva_fecha_salida'];
    $habitacionNueva = $_POST['habitacionNueva']; // Nueva habitación seleccionada en el formulario

    // Calcular la cantidad de días reservados
    $fechaLlegada = new DateTime($nuevaFechaLlegada);
    $fechaSalida = new DateTime($nuevaFechaSalida);
    $intervalo = $fechaLlegada->diff($fechaSalida);
    $diasReservados = $intervalo->days;

    // Obtener la habitación actual del huésped
    $habitacionActual = $rowHuesped['habitacion'];

    if ($habitacionNueva == "noCambiar") {
        // El usuario eligió no cambiar la habitación, mantener la habitación actual
        $habitacion = $habitacionActual;
    } else {
        // El usuario seleccionó una nueva habitación
        $habitacion = $habitacionNueva;

        // Marcar la habitación actual como disponible en la tabla habitaciones
        $sqlHabitacionActual = "UPDATE habitaciones SET estado = 0 WHERE numero = '$habitacionActual'";
        $conn->query($sqlHabitacionActual);

        // Marcar la nueva habitación como ocupada en la tabla habitaciones
        $sqlHabitacionNueva = "UPDATE habitaciones SET estado = 1 WHERE numero = '$habitacion'";
        $conn->query($sqlHabitacionNueva);
    }

    // Consulta SQL para actualizar la reserva del huésped
    $sqlUpdateReserva = "UPDATE huespedes
                         SET habitacion = '$habitacion', fecha_checkIN = '$nuevaFechaLlegada', fecha_checkOUT = '$nuevaFechaSalida', dias_reservados = '$diasReservados'
                         WHERE ticket = '$ticket'";

    if ($conn->query($sqlUpdateReserva) === true) {
        echo '<script>
                alert("Reserva modificada con éxito.");
                window.location.href = "reservas.php";
             </script>';
    } else {
        echo "Error al modificar la reserva del huésped: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/modificar_reserva.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <title>Modificar Reserva</title>
</head>

<body>
    <!-- encabezado -->
    <header>
        <div id="logo">
            <img src="../assets/img/logoclaro.png" alt="Logo del Hotel" width="135px" height="70px">
        </div>
        <nav>
            <ul class="ul-encabezados">
                <li><a href="reservas.php">Regresar</a></li>
            </ul>
        </nav>
    </header>
    <br>
    <section class="modulo" id="modificarReserva">
        <div class="modulo-header">Modificar Reserva</div>
        <div class="modulo-content">
            <form action="" method="POST">
                <div>
                <label for="documento">Documento:</label>
                <input type="text" id="documento" name="documento" value="<?php echo $rowHuesped['documento']; ?>" readonly>
                
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $rowHuesped['nombre']; ?>" readonly>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $rowHuesped['apellido']; ?>" readonly>

                <label for="ticket">Ticket:</label>
                <input type="text" id="ticket" name="ticket" value="<?php echo $rowHuesped['ticket']; ?>" readonly>
                </div>
                <div>
                <label for="nueva_fecha_llegada">Nueva Fecha de Llegada:</label>
                <input type="date" id="nueva_fecha_llegada" name="nueva_fecha_llegada" value="<?php echo $rowHuesped['fecha_checkIN']; ?>" required>

                <label for="nueva_fecha_salida">Nueva Fecha de Salida:</label>
                <input type="date" id="nueva_fecha_salida" name="nueva_fecha_salida" value="<?php echo $rowHuesped['fecha_checkOUT']; ?>" required>

                <label for="dias_reservados">Días Reservados:</label>
                <input type="text" id="dias_reservados" name="dias_reservados" value="<?php echo $rowHuesped['dias_reservados']; ?>" readonly>
                </div>
                <div>
                <label for="habitacionActual">Habitación Actual:</label>
                <input type="text" id="habitacionActual" name="habitacionActual" value="<?php echo $habitacion; ?>" readonly>

                <label for="habitacionNueva">Seleccionar Nueva Habitación:</label>
                <select id="habitacionNueva" name="habitacionNueva">
                    <option value="noCambiar">No cambiar Habitación</option>
                    <?php
                    $sqlHabitacionesDisponibles = "SELECT numero, tipo, valor_diario FROM habitaciones WHERE estado = 0";
                    $resultHabitacionesDisponibles = $conn->query($sqlHabitacionesDisponibles);

                    while ($rowHabitacion = $resultHabitacionesDisponibles->fetch_assoc()) {
                        echo '<option value="' . $rowHabitacion['numero'] . '">'
                            . ' Habitación ' . $rowHabitacion['numero'] . ' - ' . $rowHabitacion['tipo'] . ' ($' . $rowHabitacion['valor_diario'] . ' diario)'
                            . '</option>';
                    }
                    ?>
                </select>
                </div>
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </section>
</body>

</html>
