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

// Creo variables para hacer POST con los datos dados por actualizar_incidencia.js
$idIncidencia = $_POST['idIncidencia'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];

// Consulta SQL para actualizar una entrada de la base de datos con la información anterior:
$consulta = "UPDATE incidencias SET titulo='$titulo', descripcion='$descripcion' WHERE id=$idIncidencia";

// Si la consulta tiene éxito, ejecuto if. Si no, ejecuto else:
if ($conexion->query($consulta) === TRUE) {
    // Doy mensaje de éxito y almaceno si el éxito es verdadero (si salió el if):
    $mensaje = array('exito' => true, 'aviso' => '¡Incidencia ACTUALIZADA con éxito!');
    echo json_encode($mensaje);
} else {
    // Doy mensaje de error y almaceno si el éxito es false (si salió el else):
    $mensaje = array('exito' => false, 'aviso' => 'ERROR actualizando incidencia: ' . $conexion->error);
    echo json_encode($mensaje);
}

// Cierro la conexión con la base de datos:
$conexion->close();

?>



