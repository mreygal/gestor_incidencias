// Hago que este .js escuche cuando se carga todo el HTML con DOMContentLoaded, y hago una función:
document.addEventListener('DOMContentLoaded', function() {
    // Envío datos del formulario a obtener_todas_incidencias.php para conseguir las incidencias y ...
    // ... luego crear código HTML que se "incruste" en la página:
    fetch('php/obtener_todas_incidencias.php')
        // Convierto lo resultante a objeto json (por algún motivo no funciona que el .php ya lo pase así) y lo paso a una función:
        .then(respuesta => respuesta.json())
        .then(datos => {
            // Creo un const que cree la lista de incidencias:
            const listaIncidencias = document.getElementById('listaIncidencias');
            // Me aseguro de que lo que haya en la lista esté vacío antes de meter incidencias:
            listaIncidencias.innerHTML= '';

            // Voy creando en HTML cada fila de los datos obtenidos previamente:
            datos.forEach(incidencia => {
                const fila = `
                    <tr>
                        <td class="centrar">${incidencia.id}</td>
                        <td class="centrar">${incidencia.titulo}</td>
                        <td class="centrar">${incidencia.descripcion}</td>
                        <td class="centrar">${incidencia.fecha}</td>
                        <td class="centrar">
                            <button class="espacio botonEditar" onclick="actualizarIncidencia(${incidencia.id})">Editar</button>
                            <button class="espacio botonBorrar" onclick="borrarIncidencia(${incidencia.id})">Borrar</button>
                        </td>
                    </tr>
                `;
                // Parte esencial para que vaya creando cada nueva fila:
                listaIncidencias.innerHTML += fila;
            });
        })
        //Si hay errores en este proceso, mostrará esos errores:
        .catch(error => console.error('Error:', error));
});

// Con esta función redirecciono hacia la página de edición de incidencias tomando el id de la incidencia ...
// ... como "ancla", para que se sepa qué se está editando. Quizá no sea una forma de redirección ...
// ... excesivamente segura ya que muestra código MySQL en la barra de navegación, pero es funcional:
function actualizarIncidencia(taskId) {
    window.location.href = `actualizar_incidencia.html?id=${taskId}`;
}

// Función para borrar una incidencia que se seleccione, tomando su id:
function borrarIncidencia(taskId) {
    // Hago que salga una ventana de aceptar o cancelar. Si se cancela, se para el if, si se acepta, continúa:
    if (confirm('¿Seguro que quieres eliminar esta incidencia?')) {
        // Me comunico con la base de datos a través de borrar_incidencia.php y selecciono una incidencia...
        // ... en base a su id para borrarla con el method DELETE:
        fetch(`php/borrar_incidencia.php?id=${taskId}`, { method: 'DELETE' })
            // Transformo la respuesta (lo llamo respuesta2 para que funcione y no se mezcle con lo anterior) a json y obtengo el mensaje de esos datos:
            .then(respuesta2 => respuesta2.json())
            .then(datos2 => {
                alert(datos2.aviso);
                // Actualizo la lista después de borrar la incidencia:
                location.reload();
            })
            // Si hay errores previos, se muestran:
            .catch(error => console.error('Error:', error));
    }
}


