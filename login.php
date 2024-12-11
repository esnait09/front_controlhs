<?php
session_start();
include('conexion.php'); // Conexión a la base de datos

// Validar si las claves existen en $_POST
$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if (!$username || !$password) {
    $_SESSION['error'] = "Por favor ingrese su usuario y contraseña.";
    header("Location: login.php");
    exit;
}

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
        header("Location: src/Formulario.php");
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
