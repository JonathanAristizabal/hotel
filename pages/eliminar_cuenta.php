<?php
session_start(); // Asegúrate de iniciar la sesión si vas a usar $_SESSION

include '../conections/conection.php';

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $confirmacion = $_POST["confirmacion"];
    
    if ($confirmacion === "Eliminar") {
        // Asegúrate de que el usuario esté autenticado antes de eliminar la cuenta
        if (isset($_SESSION["id_usuario"])) {
            $id_usuario = $_SESSION["id_usuario"];
            
            // Utiliza consultas preparadas para evitar la inyección SQL
            $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
            $stmt->bind_param("i", $id_usuario);
            
            if ($stmt->execute()) {
                echo "La cuenta de usuario ha sido eliminada con éxito.";
                // Aquí puedes redirigir al usuario a una página de confirmación o cerrar la sesión, etc.
            } else {
                echo "Error al eliminar la cuenta de usuario: " . $stmt->error;
            }
            
            $stmt->close();
        } else {
            echo "No tienes permisos para eliminar esta cuenta.";
        }
    } else {
        echo "La confirmación es incorrecta. La cuenta de usuario no ha sido eliminada.";
    }
    
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar cuenta de usuario</title>
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

    <section class="eliminar-usuario">
        <h1>Eliminar Cuenta de Usuario</h1>
        <p>Por favor, confirma que deseas eliminar tu cuenta de usuario.</p>
        <form action="procesar_eliminacion.php" method="POST">
            <label for="confirmacion">Escribe "Eliminar" para confirmar:</label>
            <input type="text" name="confirmacion" id="confirmacion" required>
            <button type="submit">Eliminar Cuenta</button>
        </form>
    </section>
</body>
</html>
