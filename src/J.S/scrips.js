let timerInterval;
let seconds = 0;
let isRunning = false; // Variable para controlar el estado del temporizador

function formatTime(sec) {
  const hrs = String(Math.floor(sec / 3600)).padStart(2, '0');
  const mins = String(Math.floor((sec % 3600) / 60)).padStart(2, '0');
  const secs = String(sec % 60).padStart(2, '0');
  return `${hrs}:${mins}:${secs}`;
}

function startTimer() {
  if (isRunning) return; // Evita iniciar múltiples intervalos
  isRunning = true;
  timerInterval = setInterval(() => {
    seconds++;
    document.querySelector('.cronometro').textContent = formatTime(seconds);
  }, 1000);
  toggleButtons(true);
}

function stopTimer() {
  clearInterval(timerInterval);
  isRunning = false;
  toggleButtons(false);
}

function increaseHour() {
  if (isRunning) return; // No permite aumentar la hora mientras el temporizador está en marcha
  seconds += 0;
  const formattedTime = formatTime(seconds);
  document.querySelector('.cronometro').textContent = formattedTime;
  document.getElementById('Horas_Diarias_Realizadas').value = formattedTime; // Actualiza el campo de entrada
}

function toggleButtons(disable) {
  document.getElementById('Comenzar').disabled = disable;
  document.getElementById('Parar').disabled = !disable;
  document.getElementById('Cargar_hora').disabled = disable;
}

document.getElementById('Comenzar').addEventListener('click', startTimer);
document.getElementById('Parar').addEventListener('click', stopTimer);
document.getElementById('Cargar_hora').addEventListener('click', increaseHour);

// Inicialmente, el botón de parar y aumentar la hora están deshabilitados
toggleButtons(false);

form.addEventListener('submit', async (event) => {
  event.preventDefault(); // Evitar el envío normal del formulario

  const formData = new FormData(form); // Recoge los datos del formulario

  // Depurar los valores de los campos antes de enviarlos
  console.log(
    'Horas Diarias Realizadas: ',
    document.getElementById('Horas_Diarias_Realizadas').value,
  );
  console.log('Fecha Actual: ', document.getElementById('Fecha_Actual').value);

  try {
    // Enviar los datos usando FormData (sin Content-Type)
    const response = await fetch(form.action, {
      method: 'POST',
      body: formData, // Usar FormData directamente
    });

    if (response.ok) {
      const result = await response.json();
      alert(result.message); // Muestra el mensaje de éxito
    } else {
      const errorText = await response.text();
      console.error('Error del servidor:', errorText);
      alert('Error: ' + errorText); // Muestra un mensaje de error
    }
  } catch (err) {
    console.error('Error al enviar el formulario:', err);
    alert('Ocurrió un error al enviar los datos.');
  }
});
