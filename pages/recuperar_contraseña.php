<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/recuperar_contraseña.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <title>Recuperar_contraseña</title>
</head>

<body>

    <!-- encabezado -->
    <header>
        <div id="logo">
            <img src="../assets/img/logoclaro.png" alt="Logo del Hotel" width="135px" height="70px">
        </div>
        <nav>
            <ul class="ul-encabezados">
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="login.php">Regresar</a></li>
            </ul>
        </nav>
    </header>
    <br>
    <br>
    <!-- formulario -->
    <section id="formulario">
        <h2>Recuperar Contraseña</h2>
        <form action="procesar_recuperacion.php" method="post">
            <div class="form-group">
                <label for="email">Escriba su Correo Electrónico registrado:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" value="Recuperar Contraseña">
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

</html>
