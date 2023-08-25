<?php
include '../conections/conection.php';

// Consulta SQL para obtener los datos de la tabla 'usuarios'
$sql_usuarios = "SELECT * FROM usuarios";
$result_usuarios = $conn->query($sql_usuarios);

// Consulta SQL para obtener los datos de la tabla 'facturaciones'
$sql_facturaciones = "SELECT * FROM facturaciones";
$result_facturaciones = $conn->query($sql_facturaciones);

// Consulta SQL para obtener los datos de la tabla 'habitaciones'
$sql_habitaciones = "SELECT * FROM habitaciones";
$result_habitaciones = $conn->query($sql_habitaciones);
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
    <!-- encabezado -->
    <header>
        <div id="logo">
            <img src="../assets/img/logoclaro.png" alt="Logo del Hotel" width="135px" height="70px">
        </div>
        <h1>Panel de gestión</h1>
        <nav class="navegacion">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="reservas.php">Reservas</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
    <nav class="panel">
        <!-- Menu de navegación a los módulos -->
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
        <!-- Módulo de consultar -->
        <section class="modulo" id="consultar">
            <div class="modulo-header">Consultar</div>
            <div class="modulo-content">
                <!-- Contenido del módulo de consultar... -->
                <form id="consulta-form">
                    <input type="text" id="cedula" name="cedula" placeholder="Numero de documento">
                    <br>
                    <br>
                    <button type="submit">Consultar</button>
                </form>
                <div id="resultados">
                    <!-- Aquí se mostrarán los resultados de la consulta -->
                </div>
            </div>
        </section>
        <!-- Módulo de Facturación -->
        <section class="modulo" id="facturacion">
            <div class="modulo-header">Facturación</div>
            <div class="modulo-content">
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
                        <?php
                        if ($result_facturaciones->num_rows > 0) {
                            while ($row = $result_facturaciones->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['documento'] . '</td>';
                                echo '<td>' . $row['descripcion'] . '</td>';
                                echo '<td>' . '$' . $row['valor'] . '</td>';
                                echo '<td>';
                                echo '<button class="crear-button">crear</button>';
                                echo '<button class="modificar-button">Modificar</button>';
                                echo '<button class="eliminar-button">Eliminar</button>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="4">No hay registros disponibles.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <!-- Modulo de Habitaciones -->
        <section class="modulo" id="habitaciones">
            <!-- 
                Formulario para crear habitación
             -->
            <div id="modalCrearHabitacion" class="modal">
                <div class="modal-content">
                    <h2>Crear Nueva Habitación</h2>
                    <form id="formularioCrearHabitacion" action="crear_habitacion.php" method="post">
                        <label for="numero">Número:</label>
                        <input type="number" id="numero" name="numero" required>

                        <label for="tipo">Tipo:</label>
                        <select id="tipo" name="tipo" required>
                            <option value="Individual">Individual</option>
                            <option value="Doble">Doble</option>
                            <option value="Suite">Suite</option>
                        </select>

                        <label for="descripcion">Descripción:</label>
                        <input type="text" id="descripcion" name="descripcion" required>

                        <label for="valor_diario">Valor Diario:</label>
                        <input type="number" id="valor_diario" name="valor_diario" required>

                        <button type="submit">Crear Habitación</button>
                    </form>
                </div>
            </div>

            </div>
            <button class="crear-button" id="btnCrearHabitacion">Crear nueva Habitación</button>
            <div class="modulo-header">Habitaciones</div>
            <div class="modulo-content">
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
                        <?php
                        if ($result_habitaciones->num_rows > 0) {
                            while ($row_habitaciones = $result_habitaciones->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row_habitaciones['numero'] . '</td>';
                                echo '<td>' . $row_habitaciones['tipo'] . '</td>';
                                echo '<td>' . ($row_habitaciones['estado'] == 1 ? 'Ocupada' : 'Disponible') . '</td>';
                                echo '<td>' . $row_habitaciones['descripcion'] . '</td>';
                                echo '<td>' . '$' . $row_habitaciones['valor_diario'] . '</td>';
                                echo '<td>';
                                echo '<button class="modificar-button"><a href="modificar_habitacion.php?numero=' . $row_habitaciones['numero'] . '">Modificar</a></button>';
                                echo '<button class="eliminar-button"><a href="eliminar_habitacion.php?numero=' . $row_habitaciones['numero'] . '">Eliminar</a></button>';
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

        <!-- Modulo de Huéspedes -->
        <section class="modulo" id="huespedes">
            <div class="modulo-header">Huéspedes</div>
            <div class="modulo-content">
                <table>
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Ticket</th>
                            <th>Días Reservados</th>
                            <th>Habitación</th>
                            <th>Valor Diario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Consulta SQL para obtener los datos de la tabla huespedes y habitaciones
                        $sqlHuespedes = "SELECT h.documento, h.ticket, h.dias_reservados, h.habitacion, hab.valor_diario
                                 FROM huespedes h
                                 JOIN habitaciones hab ON h.habitacion = hab.numero";
                        $resultHuespedes = $conn->query($sqlHuespedes);

                        if ($resultHuespedes->num_rows > 0) {
                            while ($rowHuespedes = $resultHuespedes->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $rowHuespedes['documento'] . '</td>';
                                echo '<td>' . $rowHuespedes['ticket'] . '</td>';
                                echo '<td>' . $rowHuespedes['dias_reservados'] . '</td>';
                                echo '<td>' . $rowHuespedes['habitacion'] . '</td>';
                                echo '<td>' . '$' . $rowHuespedes['valor_diario'] . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">No hay registros disponibles.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Módulo de Pedidos -->
        <section class="modulo" id="pedidos">
            <div class="modulo-header">Pedidos</div>
            <div class="modulo-content">
                <!-- Contenido del módulo de pedidos... -->
                <p>Contenido del módulo de pedidos...</p>
            </div>
        </section>

        <!-- Módulo de Usuarios -->
        <section class="modulo" id="usuarios">
            <div class="modulo-header">Usuarios</div>
            <div class="modulo-content">
                <table>
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_usuarios->num_rows > 0) {
                            while ($row = $result_usuarios->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['documento'] . '</td>';
                                echo '<td>' . $row['nombre'] . '</td>';
                                echo '<td>' . $row['apellido'] . '</td>';
                                echo '<td>' . $row['correo'] . '</td>';
                                echo '<td>' . $row['telefono'] . '</td>';
                                echo '<td>';
                                echo '<td>';
                                echo '<button class="modificar-button"><a href="modificar_cuenta.php?documento=' . $row['documento'] . '">Modificar</a></button>';
                                echo '<button class="eliminar-button"><a href="eliminar_cuenta.php?documento=' . $row['documento'] . '">Eliminar</a></button>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="4">No hay registros disponibles.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <button class="crear-button" id="btnCrearUsuario">Crear nuevo Usuario</button>
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

    <!-- Pie de página del panel de gestión -->
    <footer>
        <p>&copy; 2023 Panel de Gestión. Todos los derechos reservados.</p>
    </footer>
</body>
<script src="../assets/js/code.js"></script>

</html>