<!-- <?php
      include '../conexion.php';
      ?> -->

<!DOCTYPE html>
<html lang="es">

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-z6JRo76dO1YmI3jn7n+H6+DSkF03ZKf1pH1FMD7X3PkID56yC5yqIFbFJyglE3DzdloLX0RExG7XW/+vj++5BA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <meta charset="UTF-8">
  <title>Sistema de renta de Sillas y Mesas Lifetime</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap">
  <link rel="stylesheet" href="../css/oooo.css">
</head>

<body>
  <div class="container">
    <div class="form-section">
      <h1>SILLAS Y MESAS LIFETIME</h1>
      <form action="../views/dashboard.php" method="get">
        <div class="form-group">
          <table>
            <tr><button></button></tr>
            <tr>
              <a href="../views/registro.php" class="cara btn-login">Registrarse</a>
            </tr>
            <tr><button></button></tr>
            <tr>
              <a href="../views/iniciarsesion.php" class="cara btn-login">Iniciar sesión</a>
            </tr>
            <tr>
              <div class="image-section">
                <img src="../img/ia.png" alt="Mujer con laptop" />
            </tr>
          </table>
        </div>
      </form>
    </div>
  </div>

  <button id="openModal-acerca-de">Acerca de</button>

  <div class="acerca-de" id="modalAcercaDe">
    <div class="modal-acerca-de">
      <span class="close-modal" id="closeModal">&times;</span>
      <div class="content-modal">
        <h1>Acerca de</h1>
        <p>Este sistema fue desarrollado por estudiantes de la Facultad de Ingeniería Mecánica y Eléctrica.</p>
        <br>
        <ul>
          <li>Lázaro Axel Juárez Herrera</li>
          <li>Edwin Abraham Muñiz Aguilar</li>
          <li>Raúl Bayron Alvarado Sánchez</li>
          <li>Angélica Cortez Esparza</li>
          <li>Valeria Martínez Ondarza</li>
          <li>Juan Julián Palomo Bermúdez</li>
          <li>André Isaí Zermeño Ruiz</li>
          <li>Serena Domínguez García</li>
        </ul>
      </div>
    </div>
  </div>
</body>
<script>
  const openModalBtn = document.getElementById('openModal-acerca-de');
  const modal = document.getElementById('modalAcercaDe');
  const closeModalBtn = document.getElementById('closeModal');

  openModalBtn.addEventListener('click', () => {
    modal.style.display = 'block';
  });

  closeModalBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });
</script>

</html>