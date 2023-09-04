<?php
session_start();
include '../conections/conection.php';

// Verificar si se ha enviado un ID de producto válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $producto_id = $_GET['id'];

    // Consultar si el producto existe en la base de datos
    $sql = "SELECT * FROM productos WHERE id = $producto_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Producto encontrado, proceder a eliminarlo
        $delete_sql = "DELETE FROM productos WHERE id = $producto_id";

        if ($conn->query($delete_sql) === TRUE) {
            // Producto eliminado con éxito
            header("Location: panel_gestor.php"); // Redirigir a la página de gestión de productos
            exit();
        } else {
            // Error al eliminar el producto
            echo "Error al eliminar el producto: " . $conn->error;
        }
    } else {
        // Producto no encontrado en la base de datos
        echo "El producto no existe.";
    }
} else {
    // ID de producto no válido
    echo "ID de producto no válido.";
}
?>
