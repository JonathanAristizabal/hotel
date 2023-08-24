<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST['numero'];
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
    $valor_diario = $_POST['valor_diario'];
    $estado = 0; // Por defecto, estado disponible

    // Consulta SQL para insertar los datos en la tabla 'habitaciones'
    $sql = "INSERT INTO habitaciones (numero, tipo, estado, descripcion, valor_diario) VALUES ('$numero', '$tipo', '$estado', '$descripcion', '$valor_diario')";

    if ($conn->query($sql) === true) {
        // Redireccionar a la página principal o donde consideres apropiado
        header("Location: panel_gestor.php");
        exit();
    } else {
        echo "Error al crear la habitación: " . $conn->error;
    }
}

?>
