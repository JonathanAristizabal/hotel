<?php
session_start(); // Asegúrate de iniciar la sesión si vas a usar $_SESSION

include '../conections/conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $confirmacion = $_POST["confirmacion"];

    if ($confirmacion === "Eliminar") {
        // Asegúrate de que el usuario esté autenticado antes de eliminar la cuenta
        if (isset($_SESSION["documento"])) {
            $documento_usuario = $_SESSION["documento"];

            // Verifica si el usuario es un administrador (tipoUsuarioId = 1)
            $stmt_verificar_admin = $conn->prepare("SELECT tipoUsuarioId FROM usuarios WHERE documento = ?");
            $stmt_verificar_admin->bind_param("s", $documento_usuario);
            $stmt_verificar_admin->execute();
            $stmt_verificar_admin->bind_result($tipoUsuarioId);
            $stmt_verificar_admin->fetch();
            $stmt_verificar_admin->close();

            if ($tipoUsuarioId === 1) {
                // Si el usuario es un administrador, obtén el documento del usuario a eliminar de la URL
                if (isset($_GET["documento"])) {
                    $documento_eliminar = $_GET["documento"];

                    // Elimina la cuenta del usuario especificado en la URL
                    $stmt_eliminar = $conn->prepare("DELETE FROM usuarios WHERE documento = ?");
                    $stmt_eliminar->bind_param("s", $documento_eliminar);

                    if ($stmt_eliminar->execute()) {
                        echo "La cuenta de usuario ha sido eliminada con éxito.";
                        // Aquí puedes redirigir al usuario a una página de confirmación o realizar otras acciones necesarias.
                    } else {
                        echo "Error al eliminar la cuenta de usuario: " . $stmt_eliminar->error;
                    }

                    $stmt_eliminar->close();
                } else {
                    echo "No se proporcionó un documento de usuario a eliminar en la URL.";
                }
            } else {
                echo "No tienes permisos para eliminar cuentas de usuario.";
            }
        } else {
            echo "No tienes permisos para eliminar cuentas de usuario.";
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
    <link rel="stylesheet" href="../assets/css/eliminar_cuenta.css">
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
        <form action="" method="POST">
            <label for="confirmacion">Escribe "Eliminar" para confirmar:</label>
            <input type="text" name="confirmacion" id="confirmacion" required>
            <button type="submit">Eliminar Cuenta</button>
        </form>
    </section>
</body>

</html>