<?php
$servername = "localhost";
$username = "root";  // Usuario por defecto en XAMPP
$password = "";  // Sin contraseña por defecto en XAMPP
$dbname = "gestion_desarrollo";  // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
