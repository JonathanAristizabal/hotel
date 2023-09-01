<?php
/* Importar la base de datos */
include '../conections/conection.php';

session_start(); // Iniciar la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documento = $_POST['documento']; // Obtener el documento ingresado en el formulario
    $contrasena = $_POST['contrasena']; // Obtener la contraseña ingresada en el formulario
    $sql = "SELECT contrasena FROM usuarios WHERE documento = '$documento'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['contrasena']; // Obtener la contraseña almacenada en la base de datos

        // Verificar si la contraseña ingresada coincide con la almacenada en la base de datos
        if (password_verify($contrasena, $hashed_password)) {
            $_SESSION["documento"] = $documento; // Guardar el documento del usuario en la sesión
            header("Location: panel_gestor.php"); // Cambiar la ruta según sea necesario
        } else {
            echo "Usuario o contraseña incorrectas";
        }
    } else {
        echo "Usuario o contraseña incorrectas";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <title>login</title>
</head>

<body>

    <!-- encabezado -->
    <header>
        <!-- Logo  -->
        <div id="logo">
            <img src="../assets/img/logoclaro.png" alt="Logo del Hotel" width="135px" height="70px">
        </div>
        <nav>
            <ul>
                <li><a href="../index.php">Inicio</a></li>
            </ul>
        </nav>
    </header>
    <br>
    <br>
    <!-- formulario -->
    <section id="formulario">
        <h2>Iniciar Sesión</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="documento">Usuario:</label>
                <input type="text" id="documento" name="documento" required placeholder="Ingresa tu documento">
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required placeholder="Ingresa tu contraseña">
            </div>
            <br>
            <div class="form-group">
                <input type="submit" value="Iniciar Sesión">
            </div>
            <br>
            <br>
            <ul>
                <li><a href="recuperar_contraseña.php">Recordar contraseña</a></li>
                <li><a href="crear_cuenta.php">Crear cuenta</a></li>
            </ul>
        </form>
    </section>
    <br>
    </main>
    <br>

    <!-- pie de pagina -->
    <footer>
        <nav>
            <ul>
                <li><a href="#">Políticas</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="#">Politicas de cookies</a></li>
                <li><a href="#">Enlaces</a></li>
            </ul>
        </nav>
        <p class="derechos-reservados">&copy; 2023 SGH SLEEP. Todos los derechos reservados.</p>
    </footer>
</body>

</html>