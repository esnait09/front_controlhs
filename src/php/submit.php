<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['Nombre_y_Apellido'];
    $proyecto = $_POST['Tipo_de_proyecto'];
    $descripcion = $_POST['Descripcion_De_Lo_Realizado'];
    $horasRealizadas = $_POST['Horas_Diarias_Realizadas'];
    $fecha = date("Y-m-d"); // Fecha actual
    $horasEsperadas = $_POST['horas_esperadas'] ?? 0.0; // Valor decimal

    $query = "INSERT INTO registros (Nombre_y_Apellido, Tipo_de_proyecto, Descripcion_De_Lo_Realizado, Horas_Diarias_Realizadas, Fecha_Actual, Horas_Esperadas)
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $nombre, $proyecto, $descripcion, $horasRealizadas, $fecha, $horasEsperadas);

    if ($stmt->execute()) {
        header("Location: ../formulario.php");
    } else {
        echo "Error al guardar los datos: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
