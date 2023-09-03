<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];
    $sql = "SELECT nombre, apellido FROM usuarios WHERE documento = '$documento'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $data = array('nombre' => $row['nombre'], 'apellido' => $row['apellido']);
        echo json_encode($data);
    }
}
?>
