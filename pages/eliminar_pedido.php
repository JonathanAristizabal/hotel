<?php
include '../conections/conection.php'; // Incluye tu archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['ticket'])) {
    $ticket = $_GET['ticket'];

    // Consulta SQL para obtener el documento del huésped con el ticket dado
    $sqlHuespedes = "SELECT * FROM pedidos WHERE ticket = '$ticket'";
    $resultHuespedes = $conn->query($sqlHuespedes);

    if ($resultHuespedes) {
        if ($resultHuespedes->num_rows > 0) {
            $rowDocumento = $resultHuespedes->fetch_assoc();
            $documento = $rowDocumento['documento'];

            // Consulta SQL para eliminar el pedido por documento del huésped
            $sql = "DELETE FROM pedidos WHERE documento = '$documento'";

            if ($conn->query($sql) === true) {
                // Redireccionar a la página principal o donde consideres apropiado
                header("Location: panel_gestor.php");
                exit();
            } else {
                echo "Error al eliminar el pedido: " . $conn->error;
            }
        } else {
            echo "No se encontraron huéspedes con el ticket proporcionado.";
        }
    } else {
        echo "Error en la consulta: " . $conn->error;
    }
}
?>
