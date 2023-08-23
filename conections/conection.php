<?php
$servername = "localhost";  // Cambiar a la dirección del servidor si es necesario
$username = "root";
$password = "";
$dbname = "hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
