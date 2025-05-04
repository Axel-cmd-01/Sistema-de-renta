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
          <p><strong>5ㅤ</strong> Mesas Disponibles
            <img src="../img/mesa.png" alt="Mesa" class="icono" />
          </p>
        </div>
        <div class="card">
          <p><strong>50ㅤ</strong> Sillas Disponibles
            <img src="../img/silla.png" alt="Silla" class="icono" />
          </p>
        </div>
      </section>

      <section class="evento">
        <form>
          <label>Cliente:</label>
          <input type="text" required>

          <label>Dirección:</label>
          <input type="text" required>

          <div class="input-row">
            <img src="../img/silla.png" alt="Silla" class="icono-small" />
            <span>Sillas ($20 c/u)</span>
            <input type="number" min="0" value="0" id="sillas" required>
          </div>

          <div class="input-row">
            <img src="../img/mesa.png" alt="Mesa" class="icono-small" />
            <span>Mesas ($50 c/u)</span>
            <input type="number" min="0" value="0" id="mesas" required>
          </div>

          <div class="input-row">
            <img src="../img/flete.png" alt="Flete" class="icono-small" />
            <span>Flete ($ )</span>
            <input type="number" min="0" value="0" id="flete" required>
          </div>

          <div class="input-row">
            <img src="../img/mantel.png" alt="Mantel" class="icono-small" />
            <span>Manteles ($40 c/u)</span>
            <input type="number" min="0" value="0" id="manteles" required>
          </div>

          <label>Día:</label>
          <input type="date" required>

          <label>Hora:</label>
          <input type="time" required>

          <div class="total">
            <p>Total: <strong id="total">$0</strong></p>
          </div>

          <input type="submit" value="Agendar" style="font-family: 'Poppins', sans-serif; font-weight: 700;">

          
        </form>
      </section>
    </div>
  </main>

  <script>
    const sillas = document.getElementById('sillas');
    const mesas = document.getElementById('mesas');
    const flete = document.getElementById('flete');
    const manteles = document.getElementById('manteles');
    const total = document.getElementById('total');

    function calcularTotal() {
      const totalFinal = (sillas.value * 20) + (mesas.value * 50) + (manteles.value * 40) + (flete.value * 1);
      total.textContent = "$" + totalFinal;
    }

    sillas.addEventListener('input', calcularTotal);
    mesas.addEventListener('input', calcularTotal);
    flete.addEventListener('input', calcularTotal);
    manteles.addEventListener('input', calcularTotal);
  </script>
</body>

</html>
