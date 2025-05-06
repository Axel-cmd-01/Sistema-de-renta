<?php
session_start();
require_once '../conexion.php';

if (!isset($_SESSION['user_id'])) {
  http_response_code(401);
  exit();
}

if (!isset($_POST['evento_id'])) {
  http_response_code(400);
  exit();
}

$evento_id = $_POST['evento_id'];

try {
  $conn->beginTransaction();

  $stmt = $conn->prepare("SELECT mesas, sillas, manteles FROM eventos WHERE evento_id = ?");
  $stmt->execute([$evento_id]);
  $evento = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$evento) {
    throw new Exception("Evento no encontrado");
  }

  if ($evento['mesas'] > 0) {
    $updateStmt = $conn->prepare("UPDATE inventario SET cantidad = cantidad + ? WHERE articulo = 'mesas'");
    $updateStmt->execute([$evento['mesas']]);
  }

  if ($evento['sillas'] > 0) {
    $updateStmt = $conn->prepare("UPDATE inventario SET cantidad = cantidad + ? WHERE articulo = 'sillas'");
    $updateStmt->execute([$evento['sillas']]);
  }

  if ($evento['manteles'] > 0) {
    $updateStmt = $conn->prepare("UPDATE inventario SET cantidad = cantidad + ? WHERE articulo = 'manteles'");
    $updateStmt->execute([$evento['manteles']]);
  }

  $deleteStmt = $conn->prepare("DELETE FROM eventos WHERE evento_id = ?");
  $deleteStmt->execute([$evento_id]);

  $conn->commit();
  
  http_response_code(200);
  echo "Evento eliminado y artículos devueltos al inventario correctamente";
} catch (PDOException $e) {

  $conn->rollBack();
  http_response_code(500);
  echo "Error al procesar la eliminación: " . $e->getMessage();
} catch (Exception $e) {
  http_response_code(404);
  echo $e->getMessage();
}