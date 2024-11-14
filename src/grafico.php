<?php
include 'php/conexion.php'; // Archivo de conexión a la base de datos

$query = "SELECT Nombre_y_Apellido, SUM(TIME_TO_SEC(Horas_Diarias_Realizadas)) as total_horas
          FROM registros
          GROUP BY Nombre_y_Apellido";
$result = $conn->query($query);

$names = [];
$hours = [];

while ($row = $result->fetch_assoc()) {
    // Guardar nombres y horas en arrays
    $names[] = $row['Nombre_y_Apellido'];
    $hours[] = $row['total_horas'];
}

// Convertir arrays en formato JSON para pasarlos a JavaScript
$names_json = json_encode($names);
$hours_json = json_encode($hours);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Horas Realizadas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Gráfico de Horas Realizadas por Persona</h1>
    <canvas id="chartContainer" width="400" height="200"></canvas>
    
    <script>
        // Datos pasados desde PHP a JavaScript
        const names = <?php echo $names_json; ?>;
        const hours = <?php echo $hours_json; ?>;
        
        // Crear el gráfico con Chart.js
        const ctx = document.getElementById('chartContainer').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar', // Tipo de gráfico
            data: {
                labels: names, // Etiquetas (nombres)
                datasets: [{
                    label: 'Horas realizadas',
                    data: hours, // Datos (horas)
                    backgroundColor: '#FF5733', // Color de las barras
                    borderColor: '#C70039',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
