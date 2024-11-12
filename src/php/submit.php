<?php
include('conexion.php');

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que se recibieron los valores del formulario
    $nombre_y_apellido = $_POST['Nombre_y_Apellido'] ?? '';
    $tipo_de_proyecto = $_POST['Tipo_de_proyecto'] ?? '';
    $descripcion_de_lo_realizado = $_POST['Descripcion_De_Lo_Realizado'] ?? '';
    $Horas_Diarias_Realizadas = $_POST['Horas_Diarias_Realizadas'] ?? '';
    $fecha_actual = DateTime::createFromFormat('d/m/Y', $_POST['Fecha_Actual'])->format('Y-m-d');

    // Depurar los valores recibidos
    var_dump($_POST); // Verificar los datos recibidos
    echo "Nombre y Apellido: " . $nombre_y_apellido . "<br>";
    echo "Tipo de Proyecto: " . $tipo_de_proyecto . "<br>";
    echo "Descripción: " . $descripcion_de_lo_realizado . "<br>";
    echo "Horas Diarias: " . $Horas_Diarias_Realizadas . "<br>";
    echo "Fecha Actual: " . $fecha_actual . "<br>";

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO registros (nombre_y_apellido, tipo_de_proyecto, descripcion_de_lo_realizado, horas_diarias_realizadas, fecha_actual)
            VALUES ('$nombre_y_apellido', '$tipo_de_proyecto', '$descripcion_de_lo_realizado', '$Horas_Diarias_Realizadas', '$fecha_actual')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo registro insertado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
