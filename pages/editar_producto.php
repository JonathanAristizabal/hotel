<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/editar_productos.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <title>Modificar Producto</title>
</head>

<body>
    <!-- Encabezado -->
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
    
    <main>
        <!-- Formulario para modificar producto -->
        <section class="modulo">
            <div class="modulo-header">Modificar Producto</div>
            <br>
            <div class="modulo-content">
                <form id="modificar-producto-form" method="POST">
                    <input type="hidden" name="producto_id" value="<?= $rowProducto['id'] ?>">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $rowProducto['nombre'] ?>" required>

                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" required><?= $rowProducto['descripcion'] ?></textarea>

                    <!-- Agrega la categoría debajo de la descripción -->
                    <label for="categoria">Categoría:</label>
                    <input type="text" id="categoria" name="categoria" value="<?= $rowProducto['categoria'] ?>" required>
                    <br><br>
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" value="<?= $rowProducto['precio'] ?>" step="0.01" required>

                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" value="<?= $rowProducto['stock'] ?>" required>
                    <br>
                    <br>
                    <button class="modificar-button" type="submit">Guardar Cambios</button>
                </form>
            </div>
        </section>
    </main>
</body>

</html>
