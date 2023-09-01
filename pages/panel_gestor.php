<?php
include '../conections/conection.php';

// Verificar si la conexión a la base de datos se realizó con éxito
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consultas SQL para obtener los datos
$sql_usuarios = "SELECT * FROM usuarios";
$result_usuarios = $conn->query($sql_usuarios);

$sql_facturaciones = "SELECT * FROM facturaciones";
$result_facturaciones = $conn->query($sql_facturaciones);

$sql_habitaciones = "SELECT * FROM habitaciones";
$result_habitaciones = $conn->query($sql_habitaciones);

// Inicializa $rowCliente
$rowCliente = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documento = $_POST['cedula'];

    // Consulta SQL para obtener los detalles del cliente por número de documento
    $sqlCliente = "SELECT h.*, t.tipo AS tipo_habitacion, t.valor_diario AS valor_habitacion
                   FROM huespedes h
                   JOIN habitaciones t ON h.habitacion = t.numero
                   WHERE h.documento = '$documento'";
    $resultCliente = $conn->query($sqlCliente);

    if ($resultCliente === false) {
        echo "Error en la consulta SQL: " . $conn->error;
    } else {
        // Comprobación de si se encontró un cliente
        if ($resultCliente->num_rows == 1) {
            $rowCliente = $resultCliente->fetch_assoc();
        } else {
            $rowCliente = false;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/panel_gestor.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <title>Panel Gestor</title>
</head>

<body>
    <!-- Encabezado -->
    <header>
        <div id="logo">
            <img src="../assets/img/logoclaro.png" alt="Logo del Hotel" width="135px" height="70px">
        </div>
        <h1>Panel de gestión</h1>
        <nav class="navegacion">
            <ul>
                <li><a href="reservas.php">Reservas</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>





    <nav class="panel">
        <!-- Menú de navegación a los módulos -->
        <ul>
            <li class="consultar-item"><a href="#consultar" id="consultar-link">Consultar</a></li>
            <br>
            <br>
            <li class="facturacion-item"><a href="#facturacion" id="facturacion-link">Facturación</a></li>
            <li class="habitaciones-item"><a href="#habitaciones" id="habitaciones-link">Habitaciones</a></li>
            <li class="huespedes-item"><a href="#huespedes" id="huespedes-link">Huéspedes</a></li>
            <li class="pedidos-item"><a href="#pedidos" id="pedidos-link">Pedidos</a></li>
            <li class="usuarios-item"><a href="#usuarios" id="usuarios-link">Usuarios</a></li>
            <br>
            <br>
            <li class="configuracion-item"><a href="#configuracion" id="configuracion-link">Configuración</a></li>
        </ul>
    </nav>

    <main>
        <!-- Módulo de Consultar -->
        <section class="modulo" id="consultar">
            <div class="modulo-header">Consultas</div>
            <div class="modulo-content">
                <form id="consulta-form" method="POST">
                    <input type="text" id="cedula" name="cedula" placeholder="Número de documento">
                    <button class="boton_consultar" type="submit">Consultar</button>
                </form>
                <?php
                if ($rowCliente !== null) {
                    if ($rowCliente === false) {
                        echo '<div id="resultado-consulta"><p>Cliente no encontrado.</p></div>';
                    } else {
                        echo '<div id="resultado-consulta">';
                        echo '<h2>Detalles del Cliente</h2>';
                        echo '<p><strong>Nombre:</strong> ' . $rowCliente['nombre'] . ' ' . $rowCliente['apellido'] . '</p>';
                        echo '<p><strong>Documento:</strong> ' . $rowCliente['documento'] . '</p>';
                        echo '<p><strong>Ticket:</strong> ' . $rowCliente['ticket'] . '</p>';
                        echo '<p><strong>Días Reservados:</strong> ' . $rowCliente['dias_reservados'] . '</p>';
                        echo '<p><strong>Habitación:</strong> ' . $rowCliente['habitacion'] . '</p>';
                        echo '<p><strong>Tipo de Habitación:</strong> ' . $rowCliente['tipo_habitacion'] . '</p>';
                        echo '<p><strong>Valor Diario de la Habitación:</strong> $' . $rowCliente['valor_habitacion'] . '</p>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </section>

        <!-- Módulo de Facturación -->
        <section class="modulo" id="facturacion">
            <div class="modulo-header">Facturación</div>
            <div class="modulo-content">
                <?php if ($result_facturaciones->num_rows > 0) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Descripción</th>
                                <th>Valor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result_facturaciones->fetch_assoc()) : ?>
                                <tr>
                                    <td>
                                        <?= $row['documento'] ?>
                                    </td>
                                    <td>
                                        <?= $row['descripcion'] ?>
                                    </td>
                                    <td>$
                                        <?= $row['valor'] ?>
                                    </td>
                                    <td>
                                        <button class="crear-button">crear</button>
                                        <button class="modificar-button">Modificar</button>
                                        <button class="eliminar-button">Eliminar</button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No hay registros disponibles.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Módulo de Habitaciones -->
        <section class="modulo" id="habitaciones">
            <div><button class="crear-button" id="btnCrearHabitacion">Crear nueva Habitación</button></div>
            <br>
            <div class="modulo-header">Habitaciones</div>
            <div class="modulo-content">
                <?php if ($result_habitaciones->num_rows > 0) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Descripción</th>
                                <th>Valor Diario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row_habitaciones = $result_habitaciones->fetch_assoc()) : ?>
                                <tr>
                                    <td>
                                        <?= $row_habitaciones['numero'] ?>
                                    </td>
                                    <td>
                                        <?= $row_habitaciones['tipo'] ?>
                                    </td>
                                    <td>
                                        <?= ($row_habitaciones['estado'] == 1 ? 'Ocupada' : 'Disponible') ?>
                                    </td>
                                    <td>
                                        <?= $row_habitaciones['descripcion'] ?>
                                    </td>
                                    <td>$
                                        <?= $row_habitaciones['valor_diario'] ?>
                                    </td>
                                    <td>
                                        <button class="modificar-button" style="color: white;"><a href="modificar_habitacion.php?numero=<?= $row_habitaciones['numero'] ?>" style="color: white; text-decoration: none;">Modificar</a></button>
                                        <button class="eliminar-button" style="color: white;"><a href="eliminar_habitacion.php?numero=<?= $row_habitaciones['numero'] ?>" style="color: white; text-decoration: none;">Eliminar</a></button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No hay registros disponibles.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Módulo de Huéspedes -->
        <section class="modulo" id="huespedes">
            <div class="modulo-header">Huéspedes</div>
            <div class="modulo-content">
                <?php
                // Consulta SQL para obtener los datos de la tabla huéspedes y habitaciones
                $sqlHuespedes = "SELECT  h.documento, h.ticket, h.dias_reservados, h.habitacion, hab.valor_diario, u.nombre, u.apellido
                FROM huespedes h
                JOIN habitaciones hab ON h.habitacion = hab.numero
                JOIN usuarios u ON h.documento = u.documento";
                $resultHuespedes = $conn->query($sqlHuespedes);
                if ($resultHuespedes->num_rows > 0) :
                ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Ticket</th>
                                <th>Días Reservados</th>
                                <th>Habitación</th>
                                <th>Valor Diario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($rowHuespedes = $resultHuespedes->fetch_assoc()) : ?>
                                <tr>
                                    <td><?= $rowHuespedes['documento'] ?></td>
                                    <td><?= $rowHuespedes['nombre'] ?></td>
                                    <td><?= $rowHuespedes['apellido'] ?></td>
                                    <td><?= $rowHuespedes['ticket'] ?></td>
                                    <td><?= $rowHuespedes['dias_reservados'] ?></td>
                                    <td><?= $rowHuespedes['habitacion'] ?></td>
                                    <td>$<?= $rowHuespedes['valor_diario'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No hay registros disponibles.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Módulo de Pedidos -->
        <section class="modulo" id="pedidos">
            <div><button class="crear-button" id="btnCrearPedido">Crear nuevo Pedido</button></div>
            <br>
            <div class="modulo-header">Pedidos</div>
            <div class="modulo-content">
                <?php
                // Consulta SQL para obtener información de pedidos con nombre y apellido de usuarios
                $sqlPedidos = "SELECT p.documento, u.nombre, u.apellido, p.descripcion, p.valor, p.habitacion, h.ticket
           FROM pedidos p
           LEFT JOIN huespedes h ON p.documento = h.documento
           LEFT JOIN usuarios u ON p.documento = u.documento";
                $resultPedidos = $conn->query($sqlPedidos);
                if ($resultPedidos->num_rows > 0) :
                ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Descripción</th>
                                <th>Valor</th>
                                <th>Habitación</th>
                                <th>Ticket</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($rowPedido = $resultPedidos->fetch_assoc()) : ?>
                                <tr>
                                    <td>
                                        <?= $rowPedido['documento'] ?>
                                    </td>
                                    <td>
                                        <?= $rowPedido['nombre'] ?>
                                    </td>
                                    <td>
                                        <?= $rowPedido['apellido'] ?>
                                    </td>
                                    <td>
                                        <?= $rowPedido['descripcion'] ?>
                                    </td>
                                    <td>
                                        <?= $rowPedido['valor'] ?>
                                    </td>
                                    <td>
                                        <?= $rowPedido['habitacion'] ?>
                                    </td>
                                    <td>
                                        <?= $rowPedido['ticket'] ?>
                                    </td>
                                    <td>
                                        <button class="modificar-button" style="color: white;"><a href="modificar_pedido.php?ticket=<?= $rowPedido['ticket'] ?>" style="color: white; text-decoration: none;">Modificar</a></button>
                                        <button class="eliminar-button" style="color: white;"><a href="eliminar_pedido.php?ticket=<?= $rowPedido['ticket'] ?>" style="color: white; text-decoration: none;">Eliminar</a></button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No hay pedidos disponibles.</p>
                <?php endif; ?>
            </div>
        </section>


        <!-- Módulo de Usuarios -->
        <section class="modulo" id="usuarios">
            <div>
                <button class="crear-button" id="btnCrearUsuario">Crear nuevo Usuario</button>
            </div>
            <br>
            <div class="modulo-header">Usuarios</div>
            <div class="modulo-content">
                <?php if ($result_usuarios->num_rows > 0) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <!-- Agregamos un encabezado para la última columna -->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result_usuarios->fetch_assoc()) : ?>
                                <tr>
                                    <td><?= $row['documento'] ?></td>
                                    <td><?= $row['nombre'] ?></td>
                                    <td><?= $row['apellido'] ?></td>
                                    <td><?= $row['correo'] ?></td>
                                    <td><?= $row['telefono'] ?></td>
                                    <td>
                                        <button class="modificar-button">
                                            <a href="modificar_cuenta.php?documento=<?= $row['documento'] ?>" style="color: white; text-decoration: none;">Modificar</a>
                                        </button>
                                        <button class="eliminar-button">
                                            <a href="eliminar_cuenta.php?documento=<?= $row['documento'] ?>" style="color: white; text-decoration: none;">Eliminar</a>
                                        </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No hay registros disponibles.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Módulo de Configuración -->
        <section class="modulo" id="configuracion">
            <div class="modulo-header">Configuración</div>
            <div class="modulo-content">
                <!-- Contenido del módulo de configuración... -->
                <p>Contenido del módulo de configuración...</p>
            </div>
        </section>
    </main>
</body>
<script src="../assets/js/code.js"></script>

</html>