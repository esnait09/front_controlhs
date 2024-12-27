<?php
header('Content-Type: application/json');
include 'conexion.php';

// Consulta SQL para obtener horas realizadas y esperadas por tipo de proyecto
$query = "
SELECT 
    'Todos' AS Nombre_y_Apellido, 
    Tipo_de_proyecto, 
    SUM(TIME_TO_SEC(Horas_Diarias_Realizadas)) AS total_horas_realizadas,
    SUM(TIME_TO_SEC(Horas_Esperadas)) AS total_horas_esperadas
FROM registros
GROUP BY Tipo_de_proyecto
UNION ALL
SELECT 
    Nombre_y_Apellido, 
    Tipo_de_proyecto, 
    SUM(TIME_TO_SEC(Horas_Diarias_Realizadas)) AS total_horas_realizadas,
    SUM(TIME_TO_SEC(Horas_Esperadas)) AS total_horas_esperadas
FROM registros
GROUP BY Nombre_y_Apellido, Tipo_de_proyecto";


$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $user = $row['Nombre_y_Apellido'];
    $project = $row['Tipo_de_proyecto'];
    $realHours = $row['total_horas_realizadas'] / 3600; // Esto se queda igual, porque estás convirtiendo los segundos en horas
    $expectedHours = $row['total_horas_esperadas']; // Ya no es necesario dividir por 3600
    

    if (!isset($data[$user])) {
        $data[$user] = [
            'projects' => [],
            'real_hours' => [],
            'expected_hours' => []
        ];
    }

    $data[$user]['projects'][] = $project;
    $data[$user]['real_hours'][] = $realHours;
    $data[$user]['expected_hours'][] = $expectedHours;
}

echo json_encode($data);


?>
