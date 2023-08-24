<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Sistema de gestion hotelera</title>
</head>
<body>

    <!-- encabezado -->
    <header>
        <!-- Logo  -->
        <div id="logo">
            <img src="../assets/img/logoclaro.png" alt="Logo del Hotel" width="135px" height="70px" >
        </div>
        <nav>
            <ul class="ul-encabezado">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="panel_gestor.php">Panel</a></li>
            </ul>
        </nav>
    </header>

    <!-- portada bienvenida -->
    <main>
        <section id="bienvenida">
            <img src="../assets/img/soporte.jpg" alt="Imagen del Hotel">
            <h1>Bienvenidos</h1>
            <p>Simplificamos la gestión hotelera para que puedas concentrarte en brindar una experiencia excepcional a tus huéspedes. Optimiza reservas, gestiona habitaciones y recursos de manera eficiente, y toma decisiones informadas. ¡Descubre cómo podemos potenciar tu hotel!</p>
        </section>

    <!-- servicios -->
        <section>
            <h2 class="titulo-servicios">Servicios</h2>
        </section>
        <section id="servicios">
            <div class="servicio">
                <img src="../assets/img/analisis.jpg" alt="analisis">
                <h2>Analisis</h2>
                <p>Sistema de análisis</p>
            </div>
            <div class="servicio">
                <img src="../assets/img/negociando.jpg" alt="negocios">
                <h2>Negocios</h2>
                <p>Realiza negocios</p>
            </div>
            <div class="servicio">
                <img src="../assets/img/graficos.jpg" alt="Soporte">
                <h2>Soporte</h2>
                <p>Soporte y asistencia</p>
            </div>
        </section>
        <br>

    <!-- formulario -->
        <section id="formulario">
            <h2>Contacto</h2>
            <form action="#" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" required>
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" required></textarea>
                <br>
                <button type="submit">Enviar</button>
            </form>
        </section>
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
        <div id="inf-contacto">
            <p>Teléfono: +1 (123) 456-7890</p>
            <p>Email: info@hotel-ejemplo.com</p>
            <p>Dirección: Calle Principal, Ciudad</p>
        </div>
        <p class="derechos-reservados">&copy; 2023 SGH SLEEP. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

