<?php
session_start(); // Iniciar la sesión si aún no está iniciada

// Cerrar la sesión (puedes agregar más pasos de limpieza si es necesario)
session_destroy();

// Redirigir a la página de inicio después de cerrar sesión
echo '<script>
        alert("Sesión cerrada correctamente.");
        window.location.href = "index.php"; // Cambia "index.php" por la URL de tu página de inicio de sesión.
     </script>';
?>