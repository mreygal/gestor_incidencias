// Selecciono el formulario del HTML y hago que escuche "envio" y hago una función con ese evento:
document.getElementById('formularioIncidencias').addEventListener('submit', function(event) {
    // Prevengo el funcionamiento por defecto de un submit, que es mandarse:
    event.preventDefault();

    // Creo variable usando FormData.
    // Uso FormData porque hay datos diferentes en el formulario (int, text, date, etc.), para evitar errores:
    var datosFormulario = new FormData(this);
    
    // Envío datos del formulario a meter_incidencia.php y pido que el .php haga un POST:
    fetch('php/meter_incidencia.php', {
        method: 'POST',
        body: datosFormulario
    })
    // Paso la respuesta del fetch de meter_incidencia.php a formato json y consigo un objeto JavaScript con la respuesta:
    .then(respuesta => respuesta.json())

    // Saco datos de esa respuesta (que ya es un objeto json) y los muestro en pantalla:
    .then(datos => {
        alert(datos.aviso);
        // Reseteo el formulario tras la operación (haya sido ésta exitosa o no):
        document.getElementById('formularioIncidencias').reset();
    })
    // Si hay algún error, se hace un catch para mostrar qué error es:
    .catch(error => console.error('Error:', error));
});


