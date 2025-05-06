<?php
session_start();

date_default_timezone_set('America/Mexico_City');

if (!isset($_SESSION['user_id'])) {
  header("Location: iniciarsesion.php");
  exit();
}

$dias = [
    'Monday' => 'Lunes',
    'Tuesday' => 'Martes',
    'Wednesday' => 'Miércoles',
    'Thursday' => 'Jueves',
    'Friday' => 'Viernes',
    'Saturday' => 'Sábado',
    'Sunday' => 'Domingo'
];

$meses = [
    'January' => 'Enero',
    'February' => 'Febrero',
    'March' => 'Marzo',
    'April' => 'Abril',
    'May' => 'Mayo',
    'June' => 'Junio',
    'July' => 'Julio',
    'August' => 'Agosto',
    'September' => 'Septiembre',
    'October' => 'Octubre',
    'November' => 'Noviembre',
    'December' => 'Diciembre'
];

function formatFechaEspanol($fecha) {
    global $dias, $meses;
    $timestamp = strtotime($fecha);
    $nombreDia = $dias[date('l', $timestamp)];
    $diaMes = date('d', $timestamp);
    $nombreMes = $meses[date('F', $timestamp)];
    return "$nombreDia $diaMes de $nombreMes";
}

$username = $_SESSION['username'];
$user_role = $_SESSION['user_role'];

require_once '../conexion.php';

$stmt = $conn->prepare("SELECT articulo, cantidad FROM inventario WHERE articulo IN ('mesas', 'sillas', 'manteles')");
$stmt->execute();
$inventario = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

$stmt = $conn->query("SELECT * FROM eventos ORDER BY fecha_evento, hora_inicio");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['accion'])) {
    if (isset($_POST['mesa'])) {
      $cantidad = (int)$_POST['mesa'];
      $articulo = 'mesas';
    } elseif (isset($_POST['silla'])) {
      $cantidad = (int)$_POST['silla'];
      $articulo = 'sillas';
    } elseif (isset($_POST['mantel'])) {
      $cantidad = (int)$_POST['mantel'];
      $articulo = 'manteles';
    }

    try {
      if (strpos($_POST['accion'], 'restar') !== false) {
        $stmt = $conn->prepare("SELECT cantidad FROM inventario WHERE articulo = ?");
        $stmt->execute([$articulo]);
        $disponible = $stmt->fetchColumn();

        if ($cantidad > $disponible) {
          $_SESSION['error'] = "No hay suficientes $articulo disponibles (Solo hay $disponible)";
          header("Location: dashboard.php");
          exit();
        }
      }

      $operacion = strpos($_POST['accion'], 'sumar') !== false ? '+' : '-';
      $stmt = $conn->prepare("UPDATE inventario SET cantidad = GREATEST(0, cantidad $operacion ?) WHERE articulo = ?");
      $stmt->execute([$cantidad, $articulo]);

      $_SESSION['success'] = "Inventario de $articulo actualizado correctamente";
      header("Location: dashboard.php");
      exit();
    } catch (PDOException $e) {
      $_SESSION['error'] = "Error al actualizar inventario: " . $e->getMessage();
      header("Location: dashboard.php");
      exit();
    }
  }
}

$alert = '';
if (isset($_SESSION['error'])) {
  $alert = '<div class="alert error">' . htmlspecialchars($_SESSION['error']) . '</div>';
  unset($_SESSION['error']);
} elseif (isset($_SESSION['success'])) {
  $alert = '<div class="alert success">' . htmlspecialchars($_SESSION['success']) . '</div>';
  unset($_SESSION['success']);
}
?>

<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Sistema de renta de Sillas y Mesas Lifetime</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/dashboard.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
  <?php echo $alert; ?>

  <div class="dashboard">
    <aside class="sidebar inventario">
      <div class="user-info">
        <h2>Bienvenido</h2>
        <p class="user-role"><?php echo htmlspecialchars($user_role); ?></p>
      </div>

      <h2>Inventario</h2>
      <div class="card">
        <p><strong><?php echo $inventario['mesas'] ?? 0; ?></strong> Mesas Disponibles
          <img src="../img/mesa.png" alt="Mesa" class="mesa-icon" />
        </p>
        <button id="openModal-mesas">Gestionar Mesas</button>

        <div class="modal-mesas">
          <div class="content-modal">
            <h1>Gestionar Mesas</h1>
            <form method="POST" action="dashboard.php">
              <label for="mesa">Cantidad:</label>
              <input type="number" id="mesa" name="mesa" min="1" required>

              <div class="action-buttons">
                <button type="submit" name="accion" value="sumar_mesas">Agregar</button>
                <button type="submit" name="accion" value="restar_mesas">Quitar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="card">
        <p><strong><?php echo $inventario['sillas'] ?? 0; ?></strong> Sillas Disponibles
          <img src="../img/silla.png" alt="silla" class="mesa-icon" />
        </p>
        <button id="openModal-sillas">Gestionar Sillas</button>

        <div class="modal-sillas">
          <div class="content-modal">
            <h1>Gestionar Sillas</h1>
            <form method="POST" action="dashboard.php">
              <label for="silla">Cantidad:</label>
              <input type="number" id="silla" name="silla" min="1" required>

              <div class="action-buttons">
                <button type="submit" name="accion" value="sumar_sillas">Agregar</button>
                <button type="submit" name="accion" value="restar_sillas">Quitar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="card">
        <p><strong><?php echo $inventario['manteles'] ?? 0; ?></strong> Manteles Disponibles
          <img src="../img/mantel.png" alt="Mantel" class="mesa-icon" />
        </p>
        <button id="openModal-manteles">Gestionar Manteles</button>

        <div class="modal-manteles">
          <div class="content-modal">
            <h1>Gestionar Manteles</h1>
            <form method="POST" action="dashboard.php">
              <label for="mantel">Cantidad:</label>
              <input type="number" id="mantel" name="mantel" min="1" required>

              <div class="action-buttons">
                <button type="submit" name="accion" value="sumar_manteles">Agregar</button>
                <button type="submit" name="accion" value="restar_manteles">Quitar</button>
              </div>
            </form>
            <button class="close-modal">Cerrar</button> 
          </div>
        </div>
      </div>

      <div class="cerrarSesion">
        <a href="logout.php">Cerrar sesión</a>
      </div>
    </aside>

    <main class="main-content">
      <header>
        <h1>Eventos</h1>
        <a href="evento.php" class="add-btn">+</a>
      </header>

      <section class="tasks">
        <?php foreach ($eventos as $evento): ?>
          <div class="task">
            <div class="number"><?= $evento['evento_id'] ?></div>
            <div class="details">
              <strong><?= htmlspecialchars($evento['cliente_nombre']) ?>
                <?= !empty($evento['telefono']) ? '| ' . htmlspecialchars($evento['telefono']) : '' ?>
              </strong>
              <?php if ($evento['mesas'] > 0): ?>
                <p><?= $evento['mesas'] ?> Mesas - $<?= number_format($evento['mesas'] * 50, 2) ?></p>
              <?php endif; ?>
              <?php if ($evento['sillas'] > 0): ?>
                <p><?= $evento['sillas'] ?> Sillas - $<?= number_format($evento['sillas'] * 20, 2) ?></p>
              <?php endif; ?>
              <?php if ($evento['flete'] > 0): ?>
                <p>Flete - $<?= number_format($evento['flete'], 2) ?></p>
              <?php endif; ?>
              <?php if ($evento['manteles'] > 0): ?>
                <p>Manteles - $<?= number_format($evento['manteles'] * 40, 2) ?></p>
              <?php endif; ?>
              <p><?= htmlspecialchars($evento['direccion']) ?></p>
            </div>
            <div class="time-price">
              <p><?= formatFechaEspanol($evento['fecha_evento']) ?> - <?= date('h:i A', strtotime($evento['hora_inicio'])) ?></p>
              <p>$<?= number_format($evento['total'], 2) ?></p>
              <button class="delete-event" data-id="<?= $evento['evento_id'] ?>">
                <span class="material-symbols-outlined">delete</span>
              </button>
            </div>
          </div>
        <?php endforeach; ?>
      </section>
    </main>
  </div>

  <script>
    document.querySelectorAll('[id^="openModal-"]').forEach(btn => {
      btn.addEventListener('click', () => {
        const modalType = btn.id.replace('openModal-', '');
        document.querySelector(`.modal-${modalType}`).style.visibility = 'visible';
      });
    });

    document.querySelectorAll('.modal-mesas, .modal-sillas, .modal-manteles').forEach(modal => {
      modal.addEventListener('click', (e) => {
        if (e.target === modal || e.target.classList.contains('close-modal')) {
          modal.style.visibility = 'hidden';
          modal.querySelector('form').reset();
        }
      });
    });

    document.querySelectorAll('.content-modal').forEach(content => {
      content.addEventListener('click', (e) => {
        e.stopPropagation();
      });
    });

    document.addEventListener('DOMContentLoaded', function() {
      const alerts = document.querySelectorAll('.alert');

      alerts.forEach(alert => {
        setTimeout(() => {
          alert.style.animation = 'fadeOut 0.5s ease-out forwards';
          setTimeout(() => {
            if (alert.parentNode) {
              alert.parentNode.removeChild(alert);
            }
          }, 500);
        }, 2500); 

        alert.addEventListener('click', () => {
          alert.style.animation = 'fadeOut 0.3s ease-out forwards';
          setTimeout(() => {
            if (alert.parentNode) {
              alert.parentNode.removeChild(alert);
            }
          }, 300);
        });
      });
    });

    document.querySelectorAll('.delete-event').forEach(btn => {
      btn.addEventListener('click', async (e) => {
        e.stopPropagation();
        const eventId = btn.getAttribute('data-id');

        if (confirm('¿Estás seguro de que deseas eliminar este evento?')) {
          try {
            const response = await fetch('eliminar_evento.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: `evento_id=${eventId}`
            });

            if (response.ok) {
              window.location.reload(); 
            } else {
              alert('Error al eliminar el evento');
            }
          } catch (error) {
            console.error('Error:', error);
            alert('Error al conectar con el servidor');
          }
        }
      });
    });
  </script>
</body>

</html>