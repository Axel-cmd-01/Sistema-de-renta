<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Sistema de renta de Sillas y Mesas Lifetime</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/dashboard.css">

  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    rel="stylesheet" />


</head>

<body>
  <div class="dashboard">
    <aside class="sidebar inventario">
      <h2>Inventario</h2>
      <div class="card">
        <p><strong>5</strong> Mesas Disponibles
          <img src="../img/mesa.png" alt="Mesa" class="mesa-icon" />
        </p>
        <button id="openModal-mesas">+ Agregar Mesas</button>

        <div class="modal-mesas">
          <div class="content-modal">
            <h1>Agregar Mesa</h1>
            <form>
              <label for="mesa">Cantidad de Mesas:</label>
              <input type="number" id="mesa" name="mesa" min="1">
              <button type="submit">Agregar</button>
            </form>
            <button class="close-modal">Cerrar</button>
          </div>
        </div>
      </div>

      <div class="card">
        <p><strong>50</strong> Sillas Disponibles
          <img src="../img/silla.png" alt="silla" class="mesa-icon" />
        </p>
        <button id="openModal-sillas">+ Agregar Sillas</button>
      </div>

      <div class="modal-sillas">
        <div class="content-modal">
          <h1>Agregar Silla</h1>
          <form>
            <label for="silla">Cantidad de Sillas:</label>
            <input type="number" id="silla" name="silla" min="1">
            <button type="submit">Agregar</button>
          </form>
          <button class="close-modal">Cerrar</button>
        </div>
      </div>
    </aside>

    <main class="main-content">
      <header>
        <h1>Eventos</h1>
        <button class="add-btn">+</button>
      </header>

      <section class="tasks">
        <div class="task">
          <div class="number">1</div>
          <div class="details">
            <strong>Diana 8118044121</strong>
            <p>4 PKTS - $1,000</p>
            <p>Flete: $150</p>
            <p>Ultramar #119, Apodaca</p>
          </div>
          <div class="time-price">
            <p>Lunes 12 de mayo - 7:30 AM</p>
            <p>$1,150</p>
            <span class="material-symbols-outlined">
              check_box_outline_blank
            </span>
          </div>
        </div>

        <section class="tasks">
          <div class="task">
            <div class="number">2</div>
            <div class="details">
              <strong>Edgar 8113871026</strong>
              <p>1 PKTS - $250</p>
              <p>Flete: $150</p>
              <p>Hacienda del carmen #341, Apodaca</p>
            </div>
            <div class="time-price">
              <p>Lunes 12 de mayo - 5:00 PM</p>
              <p>$400</p>
              <span class="material-symbols-outlined">
                check_box
              </span>
            </div>
          </div>


        </section>
      </section>


      <section class="tasks">
        <div class="task">
          <div class="number">3</div>
          <div class="details">
            <strong>Karen 8113871026</strong>
            <p>2 PKTS - $500</p>
            <p>Flete: $150</p>
            <p>Ignacio Manuel Altamirano #225 Reforma 2, Apodaca</p>
          </div>
          <div class="time-price">
            <p>Lunes 12 de mayo - 6:00 PM</p>
            <p>$650</p>
          </div>
        </div>

      </section>
    </main>
  </div>
</body>

<script>
  let openmodalMesas = document.querySelector('#openModal-mesas');

  let openmodalSillas = document.querySelector('#openModal-sillas');

  openmodalMesas.addEventListener('click', () => {
    document.querySelector('.modal-mesas').style.visibility = 'visible';
  });

  openmodalSillas.addEventListener('click', () => {
    document.querySelector('.modal-sillas').style.visibility = 'visible';
  });

  document.querySelectorAll('.close-modal').forEach(button => {
    button.addEventListener('click', () => {
      document.querySelector('.modal-sillas').style.visibility = 'hidden';
      document.querySelector('.modal-mesas').style.visibility = 'hidden';
    });
  });
</script>

</html>