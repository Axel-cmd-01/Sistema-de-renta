<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: iniciarsesion.php");
    exit();
}

require_once __DIR__ . '/../conexion.php'; 

if (empty($_POST['usuario']) || empty($_POST['password'])) {
    $_SESSION['error'] = "Usuario y contraseña son requeridos";
    header("Location: iniciarsesion.php");
    exit();
}

$usuario = $_POST['usuario'];
$password = $_POST['password'];

try {
    $stmt = $conn->prepare("SELECT u.*, r.rol_nombre 
                          FROM usuario u 
                          JOIN rol r ON u.rol_id = r.rol_id 
                          WHERE u.nombre = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['clave'])) {
        // Credenciales correctas - crear sesión
        $_SESSION['user_id'] = $user['usuario_id'];
        $_SESSION['username'] = $user['nombre'];
        $_SESSION['user_role'] = $user['rol_nombre'];

        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = "Usuario o contraseña incorrectos";
        header("Location: iniciarsesion.php");
        exit();
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Error en el sistema. Por favor intenta más tarde.";
    error_log("Error de login: " . $e->getMessage());
    header("Location: iniciarsesion.php");
    exit();
}