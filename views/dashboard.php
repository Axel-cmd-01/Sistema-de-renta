<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Dashboard - Sillas y Mesas</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>
  <div class="dashboard">
    <aside class="sidebar">
      <h2>Inventario</h2>
      <div class="card">
        <p><strong>5</strong> Mesas Disponibles
          <img src="../img/mesa.png" alt="Mesa" class="mesa-icon" />

        </p>
        <button>+ Agregar Mesas</button>
      </div>
      <div class="card"> 
        <p><strong>50</strong> Sillas Disponibles
          <img src="../img/silla.png" alt="silla" class="mesa-icon" />
        </p>
        <button>+ Agregar Sillas</button>
      </div>
      <div class="calendar">
        <h3>March, 2022</h3>
        <p>(Calendario decorativo)</p>
      </div>
    </aside>

    <main class="main-content">
      <header>
        <h1>El horario de hoy</h1>
        <h2>Lunes 03</h2>
        <div class="clock">8:48 AM</div>
        <button class="add-btn">+</button>

      </header>

      <section class="tasks">
        <div class="task">
          <div class="number">4</div>
          <div class="details">
            <strong>Diana 8118044121</strong>
            <p>4 PKTS - $1,000</p>
            <p>Flete: $150</p>
            <p>Ultramar #119, Apodaca</p>
          </div>
          <div class="time-price">
            <p>7:30 AM</p>
            <p>$1,150</p>
          </div>
        </div>

        <section class="tasks">
          <div class="task">
            <div class="number">1</div>
            <div class="details">
              <strong>Edgar 8113871026</strong>
              <p>1 PKTS - $250</p>
              <p>Flete: $150</p>
              <p>Hacienda del carmen #341, Apodaca</p>
            </div>
            <div class="time-price">
              <p>5:00 PM</p>
              <p>$400</p>
            </div>
          </div>


        </section>
      </section>


      <section class="tasks">
        <div class="task">
          <div class="number">2</div>
          <div class="details">
            <strong>Karen 8113871026</strong>
            <p>2 PKTS - $500</p>
            <p>Flete: $150</p>
            <p>Ignacio Manuel Altamirano #225 Reforma 2, Apodaca</p>
          </div>
          <div class="time-price">
            <p>6:00 PM</p>
            <p>$650</p>
          </div>
        </div>


      </section>
    </main>
  </div>
</body>

</html>