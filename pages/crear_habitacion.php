<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST['numero'];
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
    $valor_diario = $_POST['valor_diario'];
    $estado = 0; // Por defecto, estado disponible

    // Consulta SQL para insertar los datos en la tabla 'habitaciones'
    $sql = "INSERT INTO habitaciones (numero, tipo, estado, descripcion, valor_diario) VALUES ('$numero', '$tipo', '$estado', '$descripcion', '$valor_diario')";

    if ($conn->query($sql) === true) {
        // Redireccionar a la página principal o donde consideres apropiado
        header("Location: panel_gestor.php");
        exit();
    } else {
        echo "Error al crear la habitación: " . $conn->error;
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/crear_habitacion.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">

    <title>Crear Habitacion</title>
</head>

<body>
     <!-- encabezado -->
     <header>
        <!-- Logo  -->
        <div id="logo">
            <img src="../assets/img/logoclaro.png" alt="Logo del Hotel" width="135px" height="70px">
        </div>
        <nav>
            <ul class="ul-encabezado">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="login.php">Regresar</a></li>
            </ul>
        </nav>
    </header>
    <br>
    
    <div id="modalCrearHabitacion" class="modal">
        <div class="modal-content">
            <h2>Crear Nueva Habitación</h2>
            <form id="formularioCrearHabitacion" action="crear_habitacion.php" method="post">
                <label for="numero">Número de habitacion:</label>
                <input type="number" id="numero" name="numero" required>

                <label for="tipo">Tipo de habitacion:</label>
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
</body>

</html>