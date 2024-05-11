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

// Creo variables y obtengo los datos de la solicitud POST enviada por meter_incidencia.js 
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];

// Creo una variable y almaceno en ella los datos de la consulta SQL para meter la incidencia:
$consulta = "INSERT INTO incidencias (titulo, descripcion) VALUES ('$titulo', '$descripcion')";

// Si la consulta tiene éxito, ejecuto if. SI no, ejecuto else:
if ($conexion->query($consulta) === TRUE) {
    // Cojo el id de la última incidencia metida con el "insert_id" de mysqli:
    $idUltimaVez = $conexion->insert_id;
    // Doy mensaje de éxito y almaceno si el éxito es true:
    $mensaje = array('exito' => true, 'aviso' => "¡Incidencia ENVIADA con éxito!\nSu número de incidencia: $idUltimaVez");
    // Lo paso a json:
    echo json_encode($mensaje);
} else {
    // Doy mensaje de error y almaceno si el éxito es falso. El mensaje de error incluye la consulta hecha y su error:
    $mensaje = array('exito' => false, 'aviso' => 'ERROR enviando incidencia: ' . $consulta . '<br>' . $conexion->error);
    // Lo paso a json: 
    echo json_encode($mensaje);
}

// Cierro la conexión:
$conexion->close();

?>




