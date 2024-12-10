fetch('datos_grafico.php')
  .then((response) => response.json())
  .then((data) => {
    console.log(data); // Verifica los datos recibidos

    // Función para convertir segundos a formato HH:MM:SS
    function segundosAHoras(segundos) {
      const horas = Math.floor(segundos / 3600);
      const minutos = Math.floor((segundos % 3600) / 60);
      const segundosRestantes = segundos % 60;
      return `${horas}:${minutos
        .toString()
        .padStart(2, '0')}:${segundosRestantes.toString().padStart(2, '0')}`;
    }

    // Convertimos los segundos a formato HH:MM:SS
    const nombres = data.map((item) => item.Nombre_y_Apellido);
    const proyectos = data.map((item) => item.Tipo_de_Proyecto);
    const horas = data.map((item) => segundosAHoras(item.total_horas));

    // Ahora generamos el gráfico con Chart.js
    new Chart(document.getElementById('graficoHoras'), {
      type: 'bar',
      data: {
        labels: nombres, // O proyectos si prefieres
        datasets: [
          {
            label: 'Horas diarias realizadas',
            data: horas,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            // Aquí podrías agregar un paso de escala para mejorar la visualización de las horas
          },
        },
      },
    });
  })
  .catch((error) => console.error('Error al obtener los datos:', error));
