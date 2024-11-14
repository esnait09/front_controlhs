<?php
session_start();
include('conexion.php'); // Conexión a la base de datos

// Obtener el usuario y la contraseña desde el formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta la tabla "usuarios"
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    // Verificar la contraseña
    if (password_verify($password, $user['password'])) {
        // Guardar username y rol en la sesión
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        
        // Redirigir a formulario.html
        header("Location: src/formulario.php");
        exit;
    } else {
        // Contraseña incorrecta
        $_SESSION['error'] = "Contraseña incorrecta.";
        header("Location: login.php");
        exit;
    }
} else {
    // Usuario no encontrado
    $_SESSION['error'] = "Usuario no encontrado.";
    header("Location: login.php");
    exit;
}
?>
