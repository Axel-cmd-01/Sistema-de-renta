<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap">
  <link rel="stylesheet" href="../css/evento.css">

  <title>Sistema de renta de Sillas y Mesas Lifetime</title>
</head>

<body>
  <main>
    <div class="contenido">
      <h1>Agendar evento</h1>
      <section class="inventario">
        <h2>Inventario</h2>
        <div class="card">
          <p><strong>5</strong> Mesas Disponibles
            <img src="../img/mesa.png" alt="Mesa" class="mesa-icon" />
          </p>
        </div>

        <div class="card">
          <p><strong>50</strong> Sillas Disponibles
            <img src="../img/silla.png" alt="silla" class="mesa-icon" />
          </p>
        </div>
      </section>

      <section class="evento">
        <form>
          <label for="cliente">Cliente:</label>
          <input type="text" id="cliente" name="cliente">

          <label for="direccion">Direccion:</label>
          <input type="text" id="direccion" name="direccion">

          <div class="sillas">
            <label for="sillas">Sillas:</label>
            <input type="number">
          </div>

          <div class="mesas">
            <label for="mesas">Mesas:</label>
            <input type="number">
          </div>

          <label for="dia">Día:</label>
          <input type="date">

          <label for="hora">Hora:</label>
          <input type="time">

          <input type="submit">
        </form>
      </section>
    </div>
  </main>
</body>

</html>