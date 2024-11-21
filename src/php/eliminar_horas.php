<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si el rol es "supervisor"
    if ($_SESSION['role'] !== 'supervisor') {
        echo "No tienes permisos para realizar esta acción.";
        exit;
    }

    // Verificar que se haya enviado una hora a eliminar
    if (!isset($_POST['horaEliminar']) || empty($_POST['horaEliminar'])) {
        echo "No se seleccionó ninguna hora para eliminar.";
        exit;
    }

    $idHora = intval($_POST['horaEliminar']); // ID de la hora a eliminar

    // Conexión a la base de datos
    include 'conexion.php';

    // Eliminar la hora seleccionada
    $query = "DELETE FROM horas WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idHora);

    if ($stmt->execute()) {
        echo "Hora eliminada correctamente.";
    } else {
        echo "Error al eliminar la hora: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
