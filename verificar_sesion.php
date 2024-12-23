<?php
session_start();
include('conexion.php'); // Conexión a la base de datos

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = array();

// Verificar si las claves existen en $_POST
$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if (!$username || !$password) {
    $response["logged_in"] = false;
    $response["error"] = "Por favor ingrese su usuario y contraseña.";
    echo json_encode($response);
    exit;
}

// Consulta a la tabla "usuarios"
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
if (!$stmt) {
    $response["logged_in"] = false;
    $response["error"] = "Error en la consulta: " . $conn->error;
    echo json_encode($response);
    exit;
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    // Verificar la contraseña
    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        $response["logged_in"] = true;
        $response["username"] = $user['username'];
        $response["role"] = $user['role'];
    } else {
        $response["logged_in"] = false;
        $response["error"] = "Contraseña incorrecta.";
    }
} else {
    $response["logged_in"] = false;
    $response["error"] = "Usuario no encontrado.";
}

$stmt->close();
echo json_encode($response);
?>
