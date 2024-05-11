// Hago que este .js escuche cuando se carga todo el HTML con DOMContentLoaded, y hago una función:
document.addEventListener('DOMContentLoaded', function() {
    // Creo una const que tenga el valor de los parámetros actuales de la URL actual, la URL de edición con su id específica:
    const parametrosURL =  new URLSearchParams(window.location.search);
    // Creo otra const con el id de la incidencia, sacándoselo a los parámetros anteriores:
    const idIncidencia = parametrosURL.get('id');

    // Llamo a obtener_incidencia.php y busco por la id específica:
    fetch(`php/obtener_incidencia.php?id=${idIncidencia}`)
        // Creo objeto json con los datos:
        .then(respuesta => respuesta.json())
        // Paso los datos json como argumento a la función y obtengo id, título y descripción ...
        // ... y nada más, porque no me hace falta la fecha:
        .then(datos => {
            document.getElementById('idIncidencia').value = datos.id;
            document.getElementById('titulo').value = datos.titulo;
            document.getElementById('descripcion').value = datos.descripcion;
        })

        // Si hay errores en el proceso, los muestro aquí:
        .catch(error => console.error('Error:', error));
});

// Selecciono el formulario del HTML y hago que escuche "submit" y hago una función con ese evento:
document.getElementById('formularioIncidencias').addEventListener('submit', function(event) {
    event.preventDefault();
    // Creo variable usando FormData.
    // Uso FormData porque hay datos diferentes en el formulario (int, text, date, etc.), para evitar errores:
    var datosFormulario = new FormData(this);

    // Envío datos del formulario a actualizar_incidencia.php y pido que el .php haga un POST:
    fetch('php/actualizar_incidencia.php', {
        method: 'POST',
        body: datosFormulario
    })
    // Paso la respuesta del fetch de actualizar_incidencia.php a formato json y consigo un objeto JavaScript con la respuesta:
    .then(respuesta2 => respuesta2.json())
    // Saco datos de esa respuesta (que ya es un objeto json) y los muestro en pantalla:
    .then(datos2 => {
        alert(datos2.aviso);
        // Redirijo a view_tasks.html para poder ver la incidencia actualizada (y el resto de incidencias que haya):
        window.location.href = 'ver_incidencias.html';
    })
    // Si hay errores, los muestro aquí:
    .catch(error => console.error('Error:', error));
});



