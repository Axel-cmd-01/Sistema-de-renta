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
      <form action="../views/dashboard.php" method="get">
        <div class="form-group">
          <label for="usuario">Usuario</label>
          <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required />
        </div>
      
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required />
          <span class="toggle-password" onclick="togglePassword()">👁</span>
        </div>
        <div class="form-group">
            <label for="password">Confirmar contraseña</label>
            <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required />
            <span class="toggle-password" onclick="togglePassword()">👁</span>
          </div>
        <button type="submit" class="btn-login">ACCESO</button>
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
  </script>
</body>
</html>
