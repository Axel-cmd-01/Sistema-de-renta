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
      <h2>Registrarse</h2>
      <form action="procesar_registro.php" method="post" onsubmit="return confirmarRegistro()">
        <div class="form-group">
          <label for="usuario">Nombre del usuario</label>
          <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required />
        </div>

        <div class="form-group">
          <label for="password">Clave del usuario</label>
          <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required />
          <span class="toggle-password" onclick="togglePassword()">👁</span>
        </div>

        <div class="form-group">
          <label for="rol">Selecciona el rol:</label>
          <select id="rol" name="rol" required>
            <option value="">Selecciona una opción</option>
            <option value="administrador">Administrador</option>
            <option value="empleado">Empleado</option>
          </select>
        </div>

        <div class="form-group">
          <a href="../views/iniciarsesion.php">Iniciar sesiòn</a>
        </div>

        <button type="submit" class="btn-login">REGISTRAR</button>
      </form>
    </div>
    <div class="image-section">
      <img src="../img/ia.png" alt="Mujer con laptop" />
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById("password");
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
      } else {
        passwordInput.type = "password";
      }
    }

    function confirmarRegistro() {
      return true;
    }

    window.onload = function() {
    <?php if(isset($_SESSION['mensaje'])): ?>
        alert('<?php echo $_SESSION['mensaje']; ?>');
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>
    
    <?php if(isset($_SESSION['error'])): ?>
        alert('Error: <?php echo $_SESSION['error']; ?>');
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
};
  </script>
</body>

</html>