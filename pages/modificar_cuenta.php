<?php
// Incluir el archivo de conexión a la base de datos
include '../conections/conection.php';


// Verificar si se ha proporcionado un documento
if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];

    // Consulta SQL para obtener los datos del usuario por su documento
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

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores actualizados del formulario
    $nuevo_correo = $_POST['correo'];
    $nuevo_nombre = $_POST['nombre'];
    $nuevo_apellido = $_POST['apellido'];
    $nuevo_telefono = $_POST['telefono'];
    $nuevo_pais = $_POST['pais'];
    $nuevo_departamento = $_POST['departamento'];
    $nueva_ciudad = $_POST['ciudad'];
    $nueva_contrasena = $_POST['contrasena'];

    // Consulta SQL para actualizar los datos del usuario
    $sqlUpdate = "UPDATE usuarios SET correo = '$nuevo_correo', nombre = '$nuevo_nombre', apellido = '$nuevo_apellido', telefono='$nuevo_telefono', pais='$nuevo_pais', departamento='$nuevo_departamento', ciudad='$nueva_ciudad', contrasena = '$nueva_contrasena' WHERE documento = '$documento'";

    if ($conn->query($sqlUpdate) === true) {
        echo '<script>
            alert("Modificación exitosa. Serás redirigido al panel de gestión.");
            window.location.href = "panel_gestor.php"; 
        </script>';
    } else {
        echo "Error al modificar el usuario: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar cuenta de usuario</title>
    <link rel="stylesheet" href="../assets/css/modificar_cuenta.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
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
    <h2>Modificar Cuenta de Usuario</h2>
    <br>
    <br>
    <main>
        <section>
            <div class="form-container">
                <form method="post" action="">
                    <label for="correo"><strong>Correo:</strong></label>
                    <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>" required><br>

                    <label for="nombre"><strong>Nombre:</strong></label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required><br>

                    <label for="apellido"><strong>Apellido:</strong></label>
                    <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>" required><br>

                    <label for="telefono"><strong>Teléfono:</strong></label>
                    <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required><br>

                    <label for="pais"><strong>País:</strong></label>
                    <input type="text" id="pais" name="pais" value="<?php echo $pais; ?>" required><br>

                    <label for="departamento"><strong>Departamento:</strong></label>
                    <input type="text" id="departamento" name="departamento" value="<?php echo $departamento; ?>" required><br>

                    <label for="ciudad"><strong>Ciudad:</strong></label>
                    <input type="text" id="ciudad" name="ciudad" value="<?php echo $ciudad; ?>" required><br>

                    <label for="contrasena"><strong>Contraseña:</strong></label>
                    <input type="password" id="contrasena" name="contrasena" value="<?php echo $contrasena; ?>" required><br>

                    <button type="submit">Modificar Usuario</button>
                </form>
            </div>
        </section>
    </main>
</body>

</html>