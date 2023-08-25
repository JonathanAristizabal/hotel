<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];

    // Consulta SQL para obtener los datos de la habitación por su número
    $sql = "SELECT * FROM usuarios WHERE documento = '$documento'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $correo = $row['correo'];
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $telefono = $row['telefono'];
        $pais = $row['pais'];
        $departamento = $row['departamento'];
        $ciudad = $row['ciudad'];
        $contrasena = $row['contrasena'];
    } else {
        echo "Usuario no encontrado.";
        exit();
    }
} else {
    echo "Documento no proporcionado.";
    exit();
}

// Cuando se envíe el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevo_correo = $row['correo'];
    $nuevo_nombre = $row['nombre'];
    $nuevo_apellido = $row['apellido'];
    $nuevo_telefono = $row['telefono'];
    $nuevo_pais = $row['pais'];
    $nuevo_departamento = $row['departamento'];
    $nueva_ciudad = $row['ciudad'];
    $nueva_contrasena = $row['contrasena'];

    // Consulta SQL para actualizar los datos de la habitación
    $sqlUpdate = "UPDATE usuarios SET correo = '$nuevo_correo', nombre = '$nuevo_nombre', apellido = ' $nuevo_apellido', telefono='$nuevo_telefono',pais='$nuevo_pais',departamento='$nuevo_departamento',ciudad='$nueva_ciudad',contrasena = '$nueva_contrasena' WHERE documento = '$documento'";

    if ($conn->query($sqlUpdate) === true) {
        echo '<script>
                        alert("Modificación exitosa. Serás redirigido al home");
                        window.location.href = "panel_gestor.php"; 
                     </script>';
    } else {
        echo "Error al modificar el usuario: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar cuenta</title>
    <link rel="stylesheet" href="../assets/css/modificar_cuenta.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
</head>
<body>
    
</body>
</html>
<body>
    <header>
        <div id="logo">
            <img src="../assets/img/logoclaro.png" alt="Logo del Hotel" width="135px" height="70px">
        </div>
        <nav>
            <ul class="ul-encabezados">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="login.php">Regresar</a></li>
            </ul>
        </nav>
    </header>
    <br>
    <h1>Modificar Cuenta</h1>
    <form method="post" action="">
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required><br>

        <label for="pais">País:</label>
        <input type="text" id="pais" name="pais" value="<?php echo $pais; ?>" required><br>

        <label for="departamento">Departamento:</label>
        <input type="text" id="departamento" name="departamento" value="<?php echo $departamento; ?>" required><br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" value="<?php echo $ciudad; ?>" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" value="<?php echo $contrasena; ?>" required><br>

        <button type="submit">Modificar Usuario</button>
    </form>
</body>

</html>


<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>