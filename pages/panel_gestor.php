<?php
session_start();
include '../conections/conection.php';

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
    $documento = $_POST['documento'];

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
            <li class="usuarios-item"><a href="#usuarios" id="usuarios-link">Usuarios</a></li>
            <li class="huespedes-item"><a href="#huespedes" id="huespedes-link">Huéspedes</a></li>
            <li class="habitaciones-item"><a href="#habitaciones" id="habitaciones-link">Habitaciones</a></li>
            <li class="pedidos-item"><a href="#pedidos" id="pedidos-link">Pedidos</a></li>
            <li class="productos-item"><a href="#productos" id="productos-link">Productos</a></li>
            <li class="facturacion-item"><a href="#facturacion" id="facturacion-link">Facturación</a></li>
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
                    <input type="text" id="documento" name="documento" placeholder="Número de documento">
                    <button class="boton_consultar" type="submit">Consultar</button>
                </form>
                <?php
                if ($rowCliente !== null) {
                    if ($rowCliente === false) {
                        echo '<div id="resultado-consulta"><p>Cliente no encontrado.</p></div>';
                    } else {
                        echo '<div id="resultado-consulta">';
                        echo '<h2>Detalles del Cliente</h2>';
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
                <?php
                // Consulta SQL para obtener los documentos de huéspedes
                $sqlHuespedes = "SELECT documento, dias_reservados, habitacion FROM huespedes";
                $resultHuespedes = $conn->query($sqlHuespedes);

                if ($resultHuespedes) {
                    if ($resultHuespedes->num_rows > 0) {
                        $facturaciones = array();

                        while ($rowHuespedes = $resultHuespedes->fetch_assoc()) {
                            $documento = $rowHuespedes['documento'];
                            $diasReservados = $rowHuespedes['dias_reservados'];
                            $habitacion = $rowHuespedes['habitacion'];

                            // Consulta SQL para obtener el valor_diario de la habitación
                            $sqlHabitacion = "SELECT valor_diario FROM habitaciones WHERE numero = '$habitacion'";
                            $resultHabitacion = $conn->query($sqlHabitacion);

                            if ($resultHabitacion && $resultHabitacion->num_rows > 0) {
                                $rowHabitacion = $resultHabitacion->fetch_assoc();
                                $valorDiario = $rowHabitacion['valor_diario'];

                                // Consulta SQL para obtener el nombre y apellido del usuario por documento
                                $sqlUsuarios = "SELECT nombre, apellido FROM usuarios WHERE documento = '$documento'";
                                $resultUsuarios = $conn->query($sqlUsuarios);

                                if ($resultUsuarios && $resultUsuarios->num_rows > 0) {
                                    $rowUsuarios = $resultUsuarios->fetch_assoc();
                                    $nombre = $rowUsuarios['nombre'];
                                    $apellido = $rowUsuarios['apellido'];
                                } else {
                                    $nombre = 'No encontrado';
                                    $apellido = 'No encontrado';
                                }

                                // Consulta SQL para obtener el total de pedidos por documento
                                $sqlPedidos = "SELECT SUM(valor) AS total_pedidos FROM pedidos WHERE documento = '$documento'";
                                $resultPedidos = $conn->query($sqlPedidos);

                                if ($resultPedidos && $resultPedidos->num_rows > 0) {
                                    $rowPedidos = $resultPedidos->fetch_assoc();
                                    $totalPedidos = $rowPedidos['total_pedidos'];
                                } else {
                                    $totalPedidos = 0;
                                }

                                // Calcular el total para la columna de hospedaje
                                $totalHospedaje = $valorDiario * $diasReservados;

                                // Calcular el total de cada usuario
                                $totalUsuario = $totalHospedaje + $totalPedidos;

                                // Agregar los datos a la lista de facturaciones
                                $facturaciones[] = array(
                                    'documento' => $documento,
                                    'nombre' => $nombre,
                                    'apellido' => $apellido,
                                    'totalHospedaje' => $totalHospedaje,
                                    'totalPedidos' => $totalPedidos,
                                    'totalUsuario' => $totalUsuario
                                );
                            }
                        }

                        // Calcular el valor total de todos los usuarios
                        $totalGeneral = 0;
                        foreach ($facturaciones as $facturacion) {
                            $totalGeneral += $facturacion['totalUsuario'];
                        }

                        // Generar la tabla HTML con los datos obtenidos
                        if (!empty($facturaciones)) {
                            echo '<table>';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>Documento</th>';
                            echo '<th>Nombre</th>';
                            echo '<th>Apellido</th>';
                            echo '<th>Hospedaje</th>';
                            echo '<th>Pedidos</th>';
                            echo '<th>Total Usuario</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            foreach ($facturaciones as $facturacion) {
                                echo '<tr>';
                                echo '<td>' . $facturacion['documento'] . '</td>';
                                echo '<td>' . $facturacion['nombre'] . '</td>';
                                echo '<td>' . $facturacion['apellido'] . '</td>';
                                echo '<td>' . $facturacion['totalHospedaje'] . '</td>';
                                echo '<td>' . $facturacion['totalPedidos'] . '</td>';
                                echo '<td>' . $facturacion['totalUsuario'] . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo '<p>No hay registros disponibles.</p>';
                        }

                        // Mostrar el valor total de todos los usuarios
                        echo '<p>Total General: ' . $totalGeneral . '</p>';
                    } else {
                        echo '<p>No hay registros disponibles.</p>';
                    }
                } else {
                    echo "Error en la consulta de huéspedes: " . $conn->error;
                }
                ?>
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
                                    <td class="descripcion">
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
                $sqlPedidos = "SELECT p.id, p.documento, u.nombre, u.apellido, p.descripcion, p.valor, p.habitacion, h.ticket
           FROM pedidos p
           LEFT JOIN huespedes h ON p.documento = h.documento
           LEFT JOIN usuarios u ON p.documento = u.documento";
                $resultPedidos = $conn->query($sqlPedidos);
                if ($resultPedidos->num_rows > 0) :
                ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
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
                                        <?= $rowPedido['id'] ?>
                                    </td>
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

        <!-- Módulo de Productos -->
        <section class="modulo" id="productos">
            <div><button class="crear-button" id="btnCrearProducto">Crear Producto</button></div>
            <br>
            <div class="modulo-header">Productos</div>
            <div class="modulo-content">
                <?php
                // Consulta SQL para obtener la lista de productos desde la base de datos
                $sqlProductos = "SELECT * FROM productos";
                $resultProductos = $conn->query($sqlProductos);

                if ($resultProductos->num_rows > 0) {
                    echo '<table>';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Descripción</th>';
                    echo '<th>Categoria</th>';
                    echo '<th>Precio</th>';
                    echo '<th>Stock</th>';
                    echo '<th>Acciones</th>'; // Agregamos una columna para las acciones
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while ($rowProducto = $resultProductos->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $rowProducto['id'] . '</td>';
                        echo '<td>' . $rowProducto['nombre'] . '</td>';
                        echo '<td>' . $rowProducto['descripcion'] . '</td>';
                        echo '<td>' . $rowProducto['categoria'] . '</td>';
                        echo '<td>$' . $rowProducto['precio'] . '</td>';
                        echo '<td>' . $rowProducto['stock'] . '</td>';
                        echo '<td>';
                        echo '<a href="editar_producto.php?id=' . $rowProducto['id'] . '"class="boton_editar_productos">Modificar</a>'; // Enlace para editar
                        echo '  ';
                        echo '<a href="eliminar_producto.php?id=' . $rowProducto['id'] . '"class="boton_eliminar_productos">Eliminar</a>'; // Enlace para eliminar
                        echo '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No hay productos disponibles.</p>';
                }
                ?>
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
                                <th>País</th>
                                <th>Departamento</th>
                                <th>Ciudad</th>
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
                                    <td><?= $row['pais'] ?></td>
                                    <td><?= $row['departamento'] ?></td>
                                    <td><?= $row['ciudad'] ?></td>
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
                <h2 class="titulos_configuracion">Configuración General</h2>
                <p class="parrafos_configuracion">Personaliza la información general de tu sistema.</p>
                <form id="configuracion-general-form" method="POST">
                    <label for="nombre_sistema">Nombre del Sistema:</label>
                    <input type="text" id="nombre_sistema" name="nombre_sistema" value="Mi Sistema de Gestión">
                    <br><br>
                    <label for="idioma">Idioma:</label>
                    <select id="idioma" name="idioma">
                        <option value="es">Español</option>
                        <option value="en">Inglés</option>
                        <option value="fr">Francés</option>
                    </select>
                    <br><br>
                    <label for="zona_horaria">Zona Horaria:</label>
                    <select id="zona_horaria" name="zona_horaria">
                        <option value="America/New_York">América/New York</option>
                        <option value="Europe/London">Europa/Londres</option>
                        <option value="Asia/Tokyo">Asia/Tokio</option>
                    </select>
                    <br><br>
                    <label for="modo_visual">Modo Visual:</label>
                    <select id="modo_visual" name="modo_visual">
                        <option value="claro">Modo Claro</option>
                        <option value="oscuro">Modo Oscuro</option>
                    </select>
                    <br><br>
                    <button type="submit" class="guardar-configuracion-button">Guardar Cambios</button>
                </form>
                <br>
                <h2 class="titulos_configuracion">Notificaciones por Correo Electrónico</h2>
                <p class="parrafos_configuracion">Configura las notificaciones por correo electrónico.</p>
                <form id="configuracion-correo-form" method="POST">
                    <label for="correo_notificaciones">Correo de Notificaciones:</label>
                    <input type="email" id="correo_notificaciones" name="correo_notificaciones" placeholder="ejemplo@dominio.com">
                    <br><br>
                    <label for="frecuencia_notificaciones">Frecuencia de Notificaciones:</label>
                    <select id="frecuencia_notificaciones" name="frecuencia_notificaciones">
                        <option value="diaria">Diaria</option>
                        <option value="semanal">Semanal</option>
                        <option value="mensual">Mensual</option>
                    </select>
                    <br><br>
                    <button type="submit" class="guardar-configuracion-button">Guardar Cambios</button>
                </form>
                <br>
                <h2 class="titulos_configuracion">Seguridad</h2>
                <p class="parrafos_configuracion">Configura las opciones de seguridad del sistema.</p>
                <form id="configuracion-seguridad-form" method="POST">
                    <label for="politica_contrasenas">Política de Contraseñas:</label>
                    <input type="checkbox" id="politica_contrasenas" name="politica_contrasenas" value="activada"> Activada
                    <br>
                    <br>
                    <label for="autenticacion_dos_factores">Autenticación de Dos Factores:</label>
                    <input type="checkbox" id="autenticacion_dos_factores" name="autenticacion_dos_factores" value="activada"> Activada
                    <br>
                    <br>
                    <button type="submit" class="guardar-configuracion-button">Guardar Cambios</button>
                </form>
            </div>
        </section>
    </main>
</body>
<script src="../assets/js/code.js"></script>

</html>