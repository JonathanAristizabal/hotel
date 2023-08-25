<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

// Consulta SQL para obtener la información de los huéspedes y sus habitaciones
$sql = "SELECT h.*, t.tipo, t.valor_diario FROM huespedes h
        JOIN habitaciones t ON h.habitacion = t.numero";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/panel_gestor.css">
    <title>Reservas</title>
</head>

<body>
    <section class="modulo" id="huespedes">
        <button class="crear-button" id="btnHacerReservacion">Hacer Reservación</button>

        <button class="" id=""><a href="panel_gestor.php">Volver</a></button>
        <div class="modulo-header">Reservas</div>
        <div class="modulo-content">
            <table>
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Ticket</th>
                        <th>Días Reservados</th>
                        <th>Habitación</th>
                        <th>Tipo de Habitación</th>
                        <th>Valor Diario</th>
                        <th>Acciónes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['documento'] . '</td>';
                            echo '<td>' . $row['ticket'] . '</td>';
                            echo '<td>' . $row['dias_reservados'] . '</td>';
                            echo '<td>' . $row['habitacion'] . '</td>';
                            echo '<td>' . $row['tipo'] . '</td>';
                            echo '<td>$' . $row['valor_diario'] . '</td>';
                            echo '<td>';
                            echo '<button class="modificar-button"><a href="modificar_reserva.php?documento=' . $row['documento'] . '">Modificar</a></button>';
                            echo '<button class="eliminar-button"><a href="eliminar_reserva.php?documento=' . $row['documento'] . '">Eliminar</a></button>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="6">No hay registros disponibles.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
<script src="../assets/js/reservas.js"></script>

</html>