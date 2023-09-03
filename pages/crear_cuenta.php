<?php
include '../conections/conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documento = $_POST['documento'];
    $correo = $_POST['email'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $pais = $_POST['pais'];
    $departamento = $_POST['departamento'];
    $ciudad = $_POST['ciudad'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];
    $tipoUsuarioId = $_POST['tipoUsuarioId'];; // Los usuarios creados por defecto serán tipo cliente


    // $tipoUsuarioId = 0; // Los usuarios creados por defecto serán tipo cliente

    // Validar que las contraseñas coincidan
    if ($contrasena !== $confirmar_contrasena) {
        echo "Las contraseñas no coinciden.";
    } else {
        // Verificar si el documento ya está registrado
        $documento_existente = $conn->query("SELECT documento FROM usuarios WHERE documento = '$documento'")->fetch_assoc();
        if ($documento_existente) {
            echo '<script>
                    alert("El documento ya está registrado.");
                    window.location.href = "crear_cuenta.php"; // Cambia "crear_cuenta.php" por la URL de la página de registro.
                 </script>';
        } else {
            $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

            // Consulta SQL para insertar los datos en la tabla 'usuarios'
            $sql = "INSERT INTO usuarios (documento, correo, nombre, apellido, telefono, pais, departamento, ciudad, contrasena, tipoUsuarioId) VALUES ('$documento', '$correo', '$nombre', '$apellido', '$telefono', '$pais', '$departamento', '$ciudad', '$contrasena_encriptada', '$tipoUsuarioId')";

            if ($conn->query($sql) === true) {
                echo '<script>
                        alert("Registro exitoso. Serás redirigido a la página de inicio de sesión.");
                        window.location.href = "login.php"; // Cambia "login.php" por la URL a la que deseas redirigir.
                     </script>';
            } else {
                echo '<script>
                        alert("Error al registrar los datos: ' . $conn->error . '");
                        window.location.href = "crear_cuenta.php"; // Cambia "crear_cuenta.php" por la URL de la página de registro.
                     </script>';
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="es">

</html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/crear_cuenta.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">

    <title>Crear cuenta</title>
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
                <li><a href="panel_gestor.php">Regresar</a></li>
            </ul>
        </nav>
    </header>
    <br>
    <br>
    <!-- formulario -->
    <section id="formulario">
        <h2>Crear Cuenta</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="documento"></label>
                <input type="text" id="documento" name="documento" required placeholder="Numero de documento">
            </div>
            <div class="form-group">
                <label for="email"></label>
                <input type="email" id="email" name="email" required placeholder="Correo electrónico">
            </div>
            <div class=" form-group">
                <label for="nombre"></label>
                <input type="text" id="nombre" name="nombre" required placeholder="Nombre">
            </div>
            <div class="form-group">
                <label for="apellido"></label>
                <input type="text" id="apellido" name="apellido" required placeholder="Apellido">
            </div>
            <div class="form-group">
                <label for="telefono"></label>
                <input type="tel" id="telefono" name="telefono" required placeholder="Teléfono">
            </div>
            <div class="form-group">
                <label for="pais"></label>
                <input type="text" id="pais" name="pais" required placeholder="Pais">
            </div>
            <div class="form-group">
                <label for="departamento"></label>
                <input type="text" id="departamento" name="departamento" required placeholder="Departamento">
            </div>
            <div class="form-group">
                <label for="ciudad"></label>
                <input type="text" id="ciudad" name="ciudad" required placeholder="Ciudad">
            </div>
            <div class="form-group">
                <label for="contrasena"></label>
                <input type="password" id="contrasena" name="contrasena" required placeholder="Ingrese una Contraseña">
            </div>
            <div class="form-group">
                <label for="contrasena"></label>
                <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required placeholder="Confirme su Contraseña">
            </div>
            <div class="form-group">
                <label for="tipo_usuario">Tipo de usuario</label>
                <select id="tipo_usuario" name="tipoUsuarioId" required>
                    <option value="1">Administrador</option>
                    <option value="0">Cliente</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" value="Crear Cuenta">
            </div>
        </form>
    </section>
    <br>
    </main>
    <br>
    <!-- pie de pagina -->
    <footer>
        <nav>
            <ul class="ul-pie">
                <li><a href="#">Políticas</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="#">Politicas de cookies</a></li>
                <li><a href="#">Enlaces</a></li>
            </ul>
        </nav>
        <p class="derechos-reservados">&copy; 2023 SGH SLEEP. Todos los derechos reservados.</p>
    </footer>
</body>
<script src="js/alert_crear.js"></script>

</html>