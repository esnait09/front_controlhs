<?php
session_start();
include('conexion.php'); // Conexión a la base de datos

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Validar si las claves existen en $_POST
$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if (!$username || !$password) {
    $_SESSION['error'] = "Por favor ingrese su usuario y contraseña.";
    header("Location: index.html?error=empty_fields");
    exit;
}

// Consulta la tabla "usuarios"
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
if (!$stmt) {
    die("Error en la consulta: " . $conn->error);
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
        
        // Redirigir sin usar echo
        header("Location: src/formulario.php");
        exit;
    } else {
        header("Location: index.html?error=incorrect_password");
        exit;
    }
} else {
    header("Location: index.html?error=user_not_found");
    exit;
}
?>
