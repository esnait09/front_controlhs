<?php
include('conexion.php');

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que se recibieron los valores del formulario
    $nombre_y_apellido = $_POST['Nombre_y_Apellido'] ?? '';
    
    // Si se ingresó un nombre personalizado, usarlo
    if ($nombre_y_apellido === 'Otro') {
        $nombre_y_apellido = $_POST['Otro_Nombre'] ?? '';
    }

    $tipo_de_proyecto = $_POST['Tipo_de_proyecto'] ?? '';
    $descripcion_de_lo_realizado = $_POST['Descripcion_De_Lo_Realizado'] ?? '';
    $horas_diarias_realizadas = $_POST['Horas_Diarias_Realizadas'] ?? '';
    $horas_esperadas = $_POST['horas_esperadas'] ?? null; // Nuevo campo: horas esperadas
    $fecha_actual = $_POST['Fecha_Actual'] ?? null;

    // Validar y formatear la fecha
    if ($fecha_actual) {
        $fecha_actual = DateTime::createFromFormat('Y-m-d', $fecha_actual)->format('Y-m-d');
    } else {
        $fecha_actual = date('Y-m-d'); // Usar fecha actual si no se proporciona
    }

    // Depurar los valores recibidos
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    echo "Nombre y Apellido: " . $nombre_y_apellido . "<br>";
    echo "Tipo de Proyecto: " . $tipo_de_proyecto . "<br>";
    echo "Descripción: " . $descripcion_de_lo_realizado . "<br>";
    echo "Horas Diarias: " . $horas_diarias_realizadas . "<br>";
    echo "Horas Esperadas: " . $horas_esperadas . "<br>";
    echo "Fecha Actual: " . $fecha_actual . "<br>";

    // Preparar la consulta SQL
    $sql = "INSERT INTO registros 
            (nombre_y_apellido, tipo_de_proyecto, descripcion_de_lo_realizado, horas_diarias_realizadas, horas_esperadas, fecha_actual)
            VALUES 
            ('$nombre_y_apellido', '$tipo_de_proyecto', '$descripcion_de_lo_realizado', '$horas_diarias_realizadas', ";

    // Manejar el caso de `NULL` para horas_esperadas
    $sql .= ($horas_esperadas !== null) ? "'$horas_esperadas'" : "NULL";
    $sql .= ", '$fecha_actual')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Datos guardados exitosamente.";
        header("Location: ../Formulario.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>
