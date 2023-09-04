<?php
session_start();
include '../conections/conection.php';

// Inicializar variables para mensajes de error y éxito
$error = "";
$success = "";

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria']; // Cambié $descripcion a $categoria
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    // Validar los datos ingresados (puedes agregar más validaciones según tus necesidades)
    if (empty($nombre) || empty($descripcion) || empty($categoria) || empty($precio) || empty($stock)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Insertar los datos en la base de datos
        $sql = "INSERT INTO productos (nombre, descripcion, categoria, precio, stock) VALUES ('$nombre', '$descripcion', '$categoria', '$precio', '$stock')";
        if ($conn->query($sql) === TRUE) {
            $success = "Producto agregado con éxito.";
        } else {
            $error = "Error al agregar el producto: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/crear_producto.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <title>Agregar Producto</title>
</head>

<body>
    <header>
        <div id="logo">
            <img src="../assets/img/logoclaro.png" alt="Logo del Hotel" width="135px" height="70px">
        </div>
        <nav>
            <ul class="ul-encabezados">
                <li><a href="panel_gestor.php">Regresar</a></li>
            </ul>
        </nav>
    </header>
    <!-- Formulario para agregar producto -->
    <section class="modulo">
        <div class="modulo-header">Agregar Producto</div>
        <div class="modulo-content">
            <?php
            if (!empty($error)) {
                echo '<p class="error">' . $error . '</p>';
            } elseif (!empty($success)) {
                echo '<p class="success">' . $success . '</p>';
            }
            ?>

            <form method="POST">
                <table class="form-table">
                    <tr>
                        <td><label for="nombre">Nombre:</label></td>
                        <td><input type="text" id="nombre" name="nombre" required></td>
                    </tr>
                    <tr>
                        <td><label for="descripcion">Descripción:</label></td>
                        <td><textarea id="descripcion" name="descripcion" required></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="categoria">Categoria:</label></td> <!-- Cambié el id a "categoria" -->
                        <td><input type="text" id="categoria" name="categoria" required></td>
                    </tr>
                    <tr>
                        <td><label for="precio">Precio:</label></td>
                        <td><input type="number" id="precio" name="precio" step="0.01" required></td>
                    </tr>
                    <tr>
                        <td><label for="stock">Stock:</label></td>
                        <td><input type="number" id="stock" name="stock" required></td>
                    </tr>
                </table>
                <button type="submit">Agregar Producto</button>
            </form>
        </div>
    </section>

    </main>
</body>
<script src="../assets/js/code.js"></script>

</html>
