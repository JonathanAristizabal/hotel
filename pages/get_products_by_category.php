<?php
// El código PHP para obtener productos por categoría se encuentra aquí
include '../conections/conection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['categoria'])) {
        $categoria = $_GET['categoria'];

        // Consulta SQL para obtener productos por categoría
        $sql = "SELECT id, nombre, precio, stock FROM productos WHERE categoria = '$categoria'";
        $result = $conn->query($sql);

        $productos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productos[] = array(
                    'id_producto' => $row['id'],
                    'nombre_producto' => $row['nombre'],
                    'precio' => $row['precio'],
                    'stock' => $row['stock']
                );
            }
        }

        // Devuelve los productos en formato JSON
        echo json_encode($productos);
    } else {
        echo "No se proporcionó una categoría válida.";
    }
}
?>