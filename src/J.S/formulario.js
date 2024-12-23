document.addEventListener('DOMContentLoaded', function () {
  const dateField = document.getElementById('Fecha_Actual');
  const currentDate = new Date();
  const formattedDate = currentDate.toISOString().split('T')[0];
  dateField.value = formattedDate;

  // Cargar opciones guardadas de nombres y tipos de proyecto desde localStorage
  const nombresGuardados = JSON.parse(localStorage.getItem('nombres')) || [];
  const tiposGuardados =
    JSON.parse(localStorage.getItem('tiposProyecto')) || [];

  const selectNombre = document.getElementById('Nombre_y_Apellido');
  nombresGuardados.forEach((nombre) => {
    const option = document.createElement('option');
    option.value = nombre;
    option.textContent = nombre.replace(/_/g, ' ');
    selectNombre.appendChild(option);
  });

  const selectTipoProyecto = document.getElementById('Tipo_de_proyecto');
  tiposGuardados.forEach((tipo) => {
    const option = document.createElement('option');
    option.value = tipo;
    option.textContent = tipo.replace(/_/g, ' ');
    selectTipoProyecto.appendChild(option);
  });
});

// Agregar/eliminar nombres
document.getElementById('agregarNombre').addEventListener('click', function () {
  const nuevoNombre = prompt('Ingrese el nuevo nombre y apellido:');
  if (nuevoNombre) {
    const nombresGuardados = JSON.parse(localStorage.getItem('nombres')) || [];
    nombresGuardados.push(nuevoNombre);
    localStorage.setItem('nombres', JSON.stringify(nombresGuardados));

    const option = document.createElement('option');
    option.value = nuevoNombre;
    option.textContent = nuevoNombre.replace(/_/g, ' ');
    document.getElementById('Nombre_y_Apellido').appendChild(option);
  }
});

document
  .getElementById('eliminarNombre')
  .addEventListener('click', function () {
    const selectNombre = document.getElementById('Nombre_y_Apellido');
    const nombreSeleccionado = selectNombre.value;

    if (nombreSeleccionado) {
      const nombresGuardados =
        JSON.parse(localStorage.getItem('nombres')) || [];
      const indice = nombresGuardados.indexOf(nombreSeleccionado);
      if (indice !== -1) {
        nombresGuardados.splice(indice, 1);
        localStorage.setItem('nombres', JSON.stringify(nombresGuardados));
      }

      const options = selectNombre.querySelectorAll('option');
      options.forEach((option) => {
        if (option.value === nombreSeleccionado) {
          selectNombre.removeChild(option);
        }
      });
    } else {
      alert('Seleccione un nombre para eliminar');
    }
  });

// Agregar/eliminar tipos de proyecto
document
  .getElementById('agregarTipoProyecto')
  .addEventListener('click', function () {
    const nuevoTipo = prompt('Ingrese el nuevo tipo de proyecto:');
    if (nuevoTipo) {
      const tiposGuardados =
        JSON.parse(localStorage.getItem('tiposProyecto')) || [];
      tiposGuardados.push(nuevoTipo);
      localStorage.setItem('tiposProyecto', JSON.stringify(tiposGuardados));

      const option = document.createElement('option');
      option.value = nuevoTipo;
      option.textContent = nuevoTipo.replace(/_/g, ' ');
      document.getElementById('Tipo_de_proyecto').appendChild(option);
    }
  });

document
  .getElementById('eliminarTipoProyecto')
  .addEventListener('click', function () {
    const selectTipoProyecto = document.getElementById('Tipo_de_proyecto');
    const tipoSeleccionado = selectTipoProyecto.value;

    if (tipoSeleccionado) {
      const tiposGuardados =
        JSON.parse(localStorage.getItem('tiposProyecto')) || [];
      const indice = tiposGuardados.indexOf(tipoSeleccionado);
      if (indice !== -1) {
        tiposGuardados.splice(indice, 1);
        localStorage.setItem('tiposProyecto', JSON.stringify(tiposGuardados));
      }

      const options = selectTipoProyecto.querySelectorAll('option');
      options.forEach((option) => {
        if (option.value === tipoSeleccionado) {
          selectTipoProyecto.removeChild(option);
        }
      });
    } else {
      alert('Seleccione un tipo de proyecto para eliminar');
    }
  });