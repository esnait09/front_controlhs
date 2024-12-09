<?php
$servername = "175.10.0.46:3309";
$username = "root";
$password = "123456";
$dbname = "gestion_desarrollo"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
