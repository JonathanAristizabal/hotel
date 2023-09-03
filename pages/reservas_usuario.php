<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas - Paradise Hotel & Resort</title>
    <link rel="shortcut icon" href="icon-ordenador.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/reservas_usuarios.css">
</head>
<body>
    <header>
        <nav>
            <a href="../index.php">Inicio</a>
            <a href="#">Habitaciones</a>
            <a href="#">Servicios</a>
            <a href="#">Contacto</a>
        </nav>
        <br>
        <section class="textos-header">
            <h1 class="titulo1">Paradise Hotel & Resort</h1>
        </section>
    </header>
    
    <main>
        <section class="contenedor">
            <h2 class="titulo2">Reserva tu Estancia</h2>
            <div class="formulario-reserva">
                <form action="procesar_reserva.php" method="POST">
                    <label for="nombre"></label>
                    <input type="text" id="nombre" name="nombre" required placeholder="Nombre:">
                    
                    <label for="correo"></label>
                    <input type="email" id="correo" name="correo" required placeholder="Correo Electrónico:">
                    
                    <label for="telefono"></label>
                    <input type="tel" id="telefono" name="telefono" required placeholder="Teléfono:">
                    
                    <label for="habitacion">Tipo de Habitación:</label>
                    <select id="habitacion" name="habitacion" required>
                        <option value="individual">Individual</option>
                        <option value="doble">Doble</option>
                        <option value="suite">Suite</option>
                    </select>
                    
                    <label for="fecha-llegada">Fecha de Llegada:</label>
                    <input type="date" id="fecha-llegada" name="fecha-llegada" required>
                    
                    <label for="fecha-salida">Fecha de Salida:</label>
                    <input type="date" id="fecha-salida" name="fecha-salida" required>
                    
                    <button type="submit">Enviar Reserva</button>
                </form>
            </div>
        </section>
    </main>
    
    <footer>
        <div class="contenedor-footer">
            <div class="content-foo">
                <h4>Teléfono</h4>
                <p>(60)6808080</p>
            </div>
            <div class="content-foo">
                <h4>Email</h4>
                <p>contacto@paradisehotel.com</p>
            </div>
        </div>
    </footer>
</body>
</html>
