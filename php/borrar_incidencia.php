<?php

// Variables para cada aspecto del mysqli:
$server = "localhost";
$user = "root";
// Estoy en modo local, así que no hay contraseña por defecto:
$pass = "";
$db = "db_gestor_incidencias";

// Hago la conexión:
$conexion = new mysqli($server, $user, $pass, $db);

// Verifico que la conexión tuvo lugar con connect_error (de mysqli):
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Creo variable que consiga la id de la incidencia específica solicitada por ver_incidencias.js:
$idIncidencia = $_GET['id'];

// Creo la consulta para borrar la incidencia que tenga un id que concuerde con la anterior:
$consulta = "DELETE FROM incidencias WHERE id = $idIncidencia";

// Si la consulta tiene éxito, ejecuto if. Si no, ejecuto else:
if ($conexion->query($consulta) === TRUE) {
    // Doy mensaje de éxito y almaceno si el éxito es true (si sale el if):
    $mensaje = array('exito' => true, 'aviso' => '¡Incidencia BORRADA con éxito!');
    echo json_encode($mensaje);
} else {
    // Doy mensaje de error y almaceno si el éxito es false (si sale el else, en definitiva):
    $mensaje = array('exito' => false, 'aviso' => 'ERROR borrando incidencia: ' . $conexion->error);
    echo json_encode($mensaje);
}

// Se cierra la conexión:
$conexion->close();

?>



