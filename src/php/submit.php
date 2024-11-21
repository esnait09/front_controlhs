<?php
include('conexion.php');

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_y_apellido = $_POST['Nombre_y_Apellido'] ?? '';

    if ($nombre_y_apellido === 'Otro') {
        $nombre_y_apellido = $_POST['Otro_Nombre'] ?? '';
    }

    $tipo_de_proyecto = $_POST['Tipo_de_proyecto'] ?? '';
    $descripcion_de_lo_realizado = $_POST['Descripcion_De_Lo_Realizado'] ?? '';
    $horas_diarias_realizadas = $_POST['Horas_Diarias_Realizadas'] ?? '';
    $horas_esperadas = $_POST['horas_esperadas'] ?? null;
    $fecha_actual = $_POST['Fecha_Actual'] ?? null;

    if ($fecha_actual) {
        $fecha_actual = DateTime::createFromFormat('Y-m-d', $fecha_actual)->format('Y-m-d');
    } else {
        $fecha_actual = date('Y-m-d');
    }

    // Verificar si ya existe un registro con el mismo tipo de proyecto
    $query_check = "SELECT * FROM registros WHERE tipo_de_proyecto = '$tipo_de_proyecto'";
    $result_check = $conn->query($query_check);

    if ($result_check && $result_check->num_rows > 0) {
        // Actualizar xd
        $sql_update = "UPDATE registros 
                       SET horas_esperadas = " . ($horas_esperadas !== null ? "'$horas_esperadas'" : "NULL") . "
                       WHERE tipo_de_proyecto = '$tipo_de_proyecto'";
        if ($conn->query($sql_update) === TRUE) {
            echo "Horas esperadas actualizadas correctamente.";
        } else {
            echo "Error al actualizar las horas esperadas: " . $conn->error;
        }
    } else {
        // Insertar un nuevo registro si no existe
        $sql_insert = "INSERT INTO registros 
                       (nombre_y_apellido, tipo_de_proyecto, descripcion_de_lo_realizado, horas_diarias_realizadas, horas_esperadas, fecha_actual)
                       VALUES 
                       ('$nombre_y_apellido', '$tipo_de_proyecto', '$descripcion_de_lo_realizado', '$horas_diarias_realizadas', ";
        $sql_insert .= ($horas_esperadas !== null) ? "'$horas_esperadas'" : "NULL";
        $sql_insert .= ", '$fecha_actual')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "Datos guardados exitosamente.";
        } else {
            echo "Error al guardar los datos: " . $conn->error;
        }
    }

    header("Location: ../Formulario.php");
    exit();
}

$conn->close();
?>
