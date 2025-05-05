<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Agregar Productos</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="../css/dashboard.css"/>
</head>
<body>
  <div class="dashboard">
    <div class="sidebar">
      <h2>Panel de Control</h2>
      <div class="cerrarSesion2">
        <a href="iniciarsesion.html">Cerrar sesión</a>
      </div>
      <div class="cerrarSesion" style="margin-top: 10px;">
        <a href="dashboard.html">Eventos</a>
      </div>
    </div>
    </div>

    <div class="main-content">
      <header>
        <h1>Gestión de Productos</h1>
      </header>

      <div class="tasks">
        <div class="task">
          <div class="details">
            <h3>Agregar nueva mesa</h3>
            <p>Registra un nuevo tipo de mesa con precio y cantidad.</p>
          </div>
          <div class="time-price">
            <button onclick="mostrarModal('modal-mesas')">Agregar</button>
          </div>
        </div>

        <div class="task">
          <div class="details">
            <h3>Agregar nueva silla</h3>
            <p>Registra un nuevo tipo de silla con precio y cantidad.</p>
          </div>
          <div class="time-price">
            <button onclick="mostrarModal('modal-sillas')">Agregar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal-mesas" id="modal-mesas">
    <div class="content-modal">
      <h2>Agregar Mesa</h2>
      <form>
        <input type="text" placeholder="Nombre de la mesa" required />
        <input type="number" placeholder="Precio" required />
        <input type="number" placeholder="Cantidad" required />
        <input type="text" placeholder="Material" required />
        <button type="submit">Guardar</button>
        <button type="button" onclick="ocultarModal('modal-mesas')">Cancelar</button>
      </form>
    </div>
  </div>


  <div class="modal-sillas" id="modal-sillas">
    <div class="content-modal">
      <h2>Agregar Silla</h2>
      <form>
        <input type="text" placeholder="Nombre de la silla" required />
        <input type="number" placeholder="Precio" required />
        <input type="number" placeholder="Cantidad" required />
        <input type="text" placeholder="Color" required />
        <button type="submit">Guardar</button>
        <button type="button" onclick="ocultarModal('modal-sillas')">Cancelar</button>
      </form>
    </div>
  </div>

  <script>
    function mostrarModal(id) {
      document.getElementById(id).style.visibility = 'visible';
    }

    function ocultarModal(id) {
      document.getElementById(id).style.visibility = 'hidden';
    }
  </script>
</body>
</html>
