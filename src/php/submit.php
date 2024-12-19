<?php
include('conexion.php');
session_start(); // Para manejar sesiones

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

    try {
        // Verificar si ya existe un registro con el mismo tipo de proyecto
        $query_check = "SELECT * FROM registros WHERE tipo_de_proyecto = ?";
        $stmt_check = $conn->prepare($query_check);
        $stmt_check->bind_param("s", $tipo_de_proyecto);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Actualizar
            $sql_update = "UPDATE registros 
                           SET horas_esperadas = ? 
                           WHERE tipo_de_proyecto = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param(
                "ss",
                $horas_esperadas,
                $tipo_de_proyecto
            );
            $stmt_update->execute();
        } else {
            // Insertar un nuevo registro si no existe
            $sql_insert = "INSERT INTO registros 
                           (nombre_y_apellido, tipo_de_proyecto, descripcion_de_lo_realizado, horas_diarias_realizadas, horas_esperadas, fecha_actual) 
                           VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param(
                "ssssss",
                $nombre_y_apellido,
                $tipo_de_proyecto,
                $descripcion_de_lo_realizado,
                $horas_diarias_realizadas,
                $horas_esperadas,
                $fecha_actual
            );
            $stmt_insert->execute();
        }

        // Si todo es exitoso, redirigir
        header("Location: ../formulario.php");
        exit();
    } catch (Exception $e) {
        // Mostrar mensaje de error en caso de fallo
        $error_message = "Hubo un error al procesar el formulario: " . $e->getMessage();
    }
}

$conn->close();
?>
