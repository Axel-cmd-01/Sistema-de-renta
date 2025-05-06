<?php
session_start();
require_once '../conexion.php';

$stmt = $conn->query("SELECT articulo, cantidad FROM inventario");
$inventario = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $conn->beginTransaction();

    $cliente = htmlspecialchars($_POST['cliente']);
    $direccion = htmlspecialchars($_POST['direccion']);
    $sillas = (int)$_POST['sillas'];
    $mesas = (int)$_POST['mesas'];
    $manteles = (int)$_POST['manteles'];
    $flete = (float)$_POST['flete'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    $total = ($sillas * 20) + ($mesas * 50) + ($manteles * 40) + $flete;

    if ($sillas > $inventario['sillas'] || $mesas > $inventario['mesas'] || $manteles > $inventario['manteles']) {
      throw new Exception("No hay suficiente inventario disponible");
    }

    $stmt = $conn->prepare("INSERT INTO eventos 
                              (cliente_nombre, direccion, mesas, sillas, manteles, flete, total, fecha_evento, hora_inicio, usuario_id)
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
      $cliente,
      $direccion,
      $mesas,
      $sillas,
      $manteles,
      $flete,
      $total,
      $fecha,
      $hora,
      $_SESSION['auth']['user_id']
    ]);

    $conn->exec("UPDATE inventario SET cantidad = cantidad - $sillas WHERE articulo = 'sillas'");
    $conn->exec("UPDATE inventario SET cantidad = cantidad - $mesas WHERE articulo = 'mesas'");
    $conn->exec("UPDATE inventario SET cantidad = cantidad - $manteles WHERE articulo = 'manteles'");

    $conn->commit();
    $_SESSION['success'] = "Evento registrado exitosamente";
    header("Location: dashboard.php");
    exit();
  } catch (Exception $e) {
    $conn->rollBack();
    $_SESSION['error'] = $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_back" />
  <link rel="stylesheet" href="../css/evento.css">

  <title>Sistema de renta de Sillas y Mesas Lifetime</title>
</head>

<body>
  <main>
    <div class="contenido">
      <div class="header">
        <a href="../views/dashboard.php"><span class="material-symbols-outlined flecha">
            arrow_back
          </span></a>
        <h1>Agendar evento</h1>
      </div>

      <section class="inventario">
        <h2>Inventario</h2>
        <div class="card">
          <p><strong><?= $inventario['mesas'] ?? 0 ?></strong> Mesas Disponibles
            <img src="../img/mesa.png" alt="Mesa" class="icono" />
          </p>
        </div>
        <div class="card">
          <p><strong><?= $inventario['sillas'] ?? 0 ?></strong> Sillas Disponibles
            <img src="../img/silla.png" alt="Silla" class="icono" />
          </p>
        </div>
        <div class="card">
          <p><strong><?= $inventario['manteles'] ?? 0 ?></strong> Manteles Disponibles
            <img src="../img/mantel.png" alt="Mantel" class="icono" />
          </p>
        </div>
      </section>

      <section class="evento">
        <form method="POST" action="evento.php">
          <label>Cliente:</label>
          <input type="text" name="cliente" required>

          <label>Teléfono:</label>
          <input type="text" name="telefono">

          <label>Dirección:</label>
          <input type="text" name="direccion" required>

         <div class="input-row">
            <img src="../img/silla.png" alt="Silla" class="icono-small" />
            <span>Sillas ($20 c/u)</span>
            <input type="number" name="sillas" min="0" max="<?= $inventario['sillas'] ?>" value="0" required>
          </div>

          <div class="input-row">
            <img src="../img/mesa.png" alt="Mesa" class="icono-small" />
            <span>Mesas ($50 c/u)</span>
            <input type="number" name="mesas" min="0" max="<?= $inventario['mesas'] ?>" value="0" required>
          </div>

          <div class="input-row">
            <img src="../img/flete.png" alt="Flete" class="icono-small" />
            <span>Flete ($)</span>
            <input type="number" name="flete" min="0" value="0" step="0.01" required>
          </div>

          <div class="input-row">
            <img src="../img/mantel.png" alt="Mantel" class="icono-small" />
            <span>Manteles ($40 c/u)</span>
            <input type="number" name="manteles" min="0" max="<?= $inventario['manteles'] ?>" value="0" required>
          </div>

          <label>Día:
            <input type="date" name="fecha" required>
          </label>

          <label>Hora:
            <input type="time" name="hora" required>
          </label>

          <div class="total">
            <span>Total:</span>
            <span id="total">$0.00</span>
          </div>

          <button type="submit">Registrar evento</button>
        </form>
      </section>
    </div>
  </main>

  <script>
    document.querySelectorAll('input[type="number"]').forEach(input => {
      input.addEventListener('input', calcularTotal);
    });

    function calcularTotal() {
      const sillas = parseInt(document.querySelector('[name="sillas"]').value) || 0;
      const mesas = parseInt(document.querySelector('[name="mesas"]').value) || 0;
      const manteles = parseInt(document.querySelector('[name="manteles"]').value) || 0;
      const flete = parseFloat(document.querySelector('[name="flete"]').value) || 0;

      const total = (sillas * 20) + (mesas * 50) + (manteles * 40) + flete;
      document.getElementById('total').textContent = '$' + total.toFixed(2);
    }
  </script>
</body>

</html>
