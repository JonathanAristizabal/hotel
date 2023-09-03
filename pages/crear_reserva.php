<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

// Obtener la lista de documentos de usuarios
$sqlDocumentos = "SELECT documento FROM usuarios";
$resultDocumentos = $conn->query($sqlDocumentos);

// Obtener la lista de habitaciones disponibles
$sqlHabitacionesDisponibles = "SELECT numero, tipo, valor_diario FROM habitaciones WHERE estado = 0";
$resultHabitacionesDisponibles = $conn->query($sqlHabitacionesDisponibles);

// Variable para mostrar mensajes de éxito o error
$reservaMensaje = "";

// Cuando se envía el formulario
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

    // Validar que la fecha de llegada y salida sean válidas
    $fechaActual = new DateTime();
    if ($fechaLlegada < $fechaActual) {
        // La fecha de llegada es anterior a la fecha actual, mostrar un mensaje de error
        echo "<script>
        alert('La fecha de llegada no puede ser anterior a la fecha actual');
        window.location.href = 'reservas.php';
      </script>";
        exit(); // Detener la ejecución
    }
    if ($fechaSalida < $fechaLlegada) {
        // La fecha de salida es anterior a la fecha de llegada, mostrar un mensaje de error
        echo "<script>
        alert('La fecha de salida no puede ser anterior a la fecha de llegada');
        window.location.href = 'reservas.php';
      </script>";
        exit(); // Detener la ejecución
    }

    // Consulta SQL para insertar la nueva reserva en la tabla huespedes
    $sqlInsertReserva = "INSERT INTO huespedes (documento, ticket, habitacion, fecha_checkIN, fecha_checkOUT, dias_reservados)
                         VALUES ('$documento','$ticket', '$habitacion', '$diaLlegada', '$diaSalida', '$diasReservados')";

    if ($conn->query($sqlInsertReserva) === true) {
        // Actualizar estado de la habitación a ocupada (estado = 1)
        $sqlUpdateHabitacion = "UPDATE habitaciones SET estado = 1 WHERE numero = '$habitacion'";
        if ($conn->query($sqlUpdateHabitacion) === false) {
            $reservaMensaje = "Error al actualizar el estado de la habitación: " . $conn->error;
        } else {
            $reservaMensaje = "Reserva exitosa. Se ha generado el ticket: $ticket";
            // Puedes redirigir al usuario a una página de éxito o a donde desees
        }
    } else {
        $reservaMensaje = "Error al realizar la reserva: " . $conn->error;
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
                    <li><a href="panel_gestor.php">Panel gestor</a></li>
                    <li><a href="reservas.php">Regresar</a></li>
                </ul>
            </nav>
        </header>
    </div>
    <br>
    <section>
        <div class="modulo-header">Crear reserva</div>
        <form action="crear_reserva.php" method="POST">
            <label for="documento">Documento:</label>
            <select id="documento" name="documento" required>
                <option value="">Selecciona un documento</option> <!-- Campo inicialmente limpio -->
                <?php
                while ($rowDocumento = $resultDocumentos->fetch_assoc()) {
                    echo '<option value="' . $rowDocumento['documento'] . '">' . $rowDocumento['documento'] . '</option>';
                }
                ?>
            </select>
            <br>

            <!-- Contenedor para mostrar nombre y apellido del cliente -->
            <div id="nombreApellidoContainer">
                <p>Nombre del cliente: <span id="nombreCliente"></span></p>
                <p>Apellido del cliente: <span id="apellidoCliente"></span></p>
            </div>

            <?php
            include '../conections/conection.php';

            // Esta parte del código se encarga de obtener el nombre y apellido del cliente
            if (isset($_GET['documento'])) {
                $documento = $_GET['documento'];
                $sql = "SELECT nombre, apellido FROM usuarios WHERE documento = '$documento'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $data = array('nombre' => $row['nombre'], 'apellido' => $row['apellido']);
                    echo json_encode($data);
                }
            }
            ?>

            <!-- Campo para seleccionar la habitación -->
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
        <!-- Mostrar mensajes de éxito o error -->
        <div class="reserva-mensaje">
            <p><?php echo $reservaMensaje; ?></p>
        </div>
    </section>
    <script src="../assets/js/nombre_apellido_reserva.js"></script>
</body>

</html>
