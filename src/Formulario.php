<?php
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulario</title>
  <link rel="stylesheet" href="CSS/stylsess.css" />
  <script src="./J.S/scrips.js" defer></script>
  <script src="./J.S/formulario.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="form-container">
    <h2>Gestión de Desarrollo</h2>
    <form action="php/submit.php" method="post">
      <!-- Campo Nombre y Apellido -->
      <label for="Nombre_y_Apellido">Nombre y Apellido:</label>
      <select id="Nombre_y_Apellido" name="Nombre_y_Apellido" required>
        <option value=""></option>
        <option value="Hernán_Vilar">Hernán Vilar</option>
        <option value="Juan_Manuel_Messina">Juan Manuel Messina</option>
        <option value="Matias_Ezequiel">Matias Ezequiel</option>
        <option value="Lucas_picchi">Lucas Picchi</option>
        <option value="Mauro_Ortiz_Davalos">Mauro Ortiz Davalos</option>
        <option value="Ricardo_Diaz">Ricardo Diaz</option>
        <option value="Franco_cuenca">Franco Cuenca</option>
        <option value="Matias_Aquino">Matias Aquino</option>
        <option value="Juan_Caminos">Juan Caminos</option>
      </select>

      <!-- Botones para agregar/eliminar nombres -->
      <?php if ($role === 'supervisor'): ?>
      <button type="button" id="agregarNombre">Agregar Nombre</button>
      <button type="button" id="eliminarNombre">Eliminar Nombre</button>
      <?php endif; ?>

      <!-- Campo Tipo de Proyecto -->
      <label for="Tipo_de_proyecto">Tipo de proyecto:</label>
      <select id="Tipo_de_proyecto" name="Tipo_de_proyecto" required>
        <option value=""></option>
        <option value="Innovacion">Innovación</option>
        <option value="Proyecto_de_Mejora">Proyecto de Mejora</option>
        <option value="Asesoramientos">Asesoramientos</option>
        <option value="Desarrollo_de_Producto">Desarrollo de Producto</option>
        <option value="Plataforma_DMD">Plataforma DMD</option>
        <option value="Pagina_local_DMD">Página local DMD</option>
      </select>

      <!-- Botones para agregar/eliminar tipos de proyecto -->
      <?php if ($role === 'supervisor'): ?>
      <button type="button" id="agregarTipoProyecto">Agregar Tipo de Proyecto</button>
      <button type="button" id="eliminarTipoProyecto">Eliminar Tipo de Proyecto</button>
      <?php endif; ?>

      <!-- Otros campos del formulario -->
      <label for="Descripcion_De_Lo_Realizado">Descripción de lo realizado:</label>
      <textarea id="Descripcion_De_Lo_Realizado" name="Descripcion_De_Lo_Realizado" required></textarea>

      <label for="Horas_Diarias_Realizadas">Horas Diarias Realizadas:</label>
      <input type="text" id="Horas_Diarias_Realizadas" name="Horas_Diarias_Realizadas" required />

      <!-- Campo Tiempo Límite solo para supervisores -->
      <?php if ($role === 'supervisor'): ?>
      <label for="Tiempo_Limite">Tiempo Límite:</label>
      <input type="number" id="Tiempo_Limite" name="Tiempo_Limite" placeholder="Ingrese tiempo en horas" min="0" step="0.1" />
      <button type="button" id="agregarTiempoLimite">Agregar Tiempo Límite</button>
      <button type="button" id="eliminarTiempoLimite">Eliminar Tiempo Límite</button>
      <?php endif; ?>

      <label for="Fecha_Actual">Fecha Actual:</label>
      <input type="text" id="Fecha_Actual" name="Fecha_Actual" readonly />

      <input type="submit" value="Cargar" />
    </form>
  </div>

  <!-- Cronómetro -->
  <div class="cronometro-container">
    <h2>Cronómetro</h2>
    <div class="cronometro">00:00:00</div>
    <div class="cronometro-buttons">
      <button id="Comenzar">Comenzar</button>
      <button id="Parar">Parar</button>
      <button id="Cargar_hora">Cargar Horas</button>
    </div>
  </div>

  <!-- Gráfico -->
  <div class="grafico-container">
    <h2>Horas Totales por Proyecto</h2>
    <canvas id="graficoHoras" width="800" height="400"></canvas>
    <!-- Script del gráfico -->
  </div>
</body>
</html>
