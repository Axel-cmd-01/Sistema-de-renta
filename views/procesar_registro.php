<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "negocioDeRenta";

session_start();

try {
  if (empty($_POST['usuario'])) {
    throw new Exception("Nombre de usuario requerido");
  }
  if (empty($_POST['password'])) {
    throw new Exception("Contraseña requerida");
  }
  if (empty($_POST['rol'])) {
    throw new Exception("Rol requerido");
  }

  $nombre = $_POST['usuario'];
  $clave = $_POST['password'];
  $rol_nombre = $_POST['rol'];

  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $check = $conn->prepare("SELECT COUNT(*) FROM usuario WHERE nombre = :nombre");
  $check->bindParam(':nombre', $nombre);
  $check->execute();

  if ($check->fetchColumn() > 0) {
    throw new Exception("El nombre de usuario ya existe");
  }

  $stmt = $conn->prepare("SELECT rol_id FROM rol WHERE rol_nombre = :rol_nombre");
  $stmt->bindParam(':rol_nombre', $rol_nombre);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$result) throw new Exception("Rol no encontrado");

  $rol_id = $result['rol_id'];
  $clave_hash = password_hash($clave, PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO usuario (rol_id, nombre, clave) VALUES (:rol_id, :nombre, :clave)");
  $stmt->bindParam(':rol_id', $rol_id);
  $stmt->bindParam(':nombre', $nombre);
  $stmt->bindParam(':clave', $clave_hash);

  if ($stmt->execute()) {
    $_SESSION['mensaje'] = 'Usuario registrado correctamente';
    header("Location: registro.php");
  } else {
    throw new Exception("Error al registrar usuario");
  }
} catch (PDOException $e) {
  $_SESSION['error'] = "Error de base de datos: " . $e->getMessage();
  header("Location: registro.php");
} catch (Exception $e) {
  $_SESSION['error'] = $e->getMessage();
  header("Location: registro.php");
}

$conn = null;
exit();
