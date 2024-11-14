<?php
// datos_grafico.php
header('Content-Type: application/json');
include 'conexion.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

// Convertir las horas en un formato numérico
$query = "SELECT Nombre_y_Apellido, Tipo_de_Proyecto, SUM(TIME_TO_SEC(Horas_Diarias_Realizadas)) as total_horas
          FROM registros
          GROUP BY Nombre_y_Apellido, Tipo_de_Proyecto";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    // Convertimos las horas totales de segundos a formato de horas
    $row['total_horas'] = $row['total_horas']; // Mantén los segundos como están
    $data[] = $row;
}

echo json_encode($data); // Devuelve los datos en formato JSON
$conn->close();
?>
