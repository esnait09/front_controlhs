<?php
header('Content-Type: application/json');
include 'conexion.php';

// Consulta SQL para obtener las horas realizadas por proyecto
$query = "
SELECT 
    Tipo_de_proyecto, 
    SUM(TIME_TO_SEC(Horas_Diarias_Realizadas)) AS total_horas_realizadas
FROM 
    registros
GROUP BY 
    Tipo_de_proyecto";

$result = $conn->query($query);

$projects = [];
$real_hours = [];
$expected_hours = [];

while ($row = $result->fetch_assoc()) {
    $projects[] = $row['Tipo_de_proyecto'];
    $real_hours[] = $row['total_horas_realizadas'] / 3600; // Convertir segundos a horas
    $expected_hours[] = 4; // Fijo: 4 horas esperadas
}

// Construir la respuesta en formato JSON
$data = [
    "projects" => $projects,
    "datasets" => [
        [
            "label" => "Horas Realizadas",
            "data" => $real_hours,
            "backgroundColor" => "rgba(54, 162, 235, 0.5)", // Azul
            "borderColor" => "rgba(54, 162, 235, 1)",
            "borderWidth" => 1
        ],
        [
            "label" => "Horas Esperadas",
            "data" => $expected_hours,
            "backgroundColor" => "rgba(255, 99, 132, 0.5)", // Rojo
            "borderColor" => "rgba(255, 99, 132, 1)",
            "borderWidth" => 1
        ]
    ]
];

echo json_encode($data);
?>
