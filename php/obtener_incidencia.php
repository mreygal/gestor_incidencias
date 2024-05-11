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

// Creo una variable y le doy el valor del id pedido por actualizar_incidencia.js:
$idIncidencia = $_GET['id'];

// Consulta SQL para obtener una incidencia concreta con el id anterior:
$consulta = "SELECT * FROM incidencias WHERE id = $idIncidencia";

// Se le da a la nueva variable "resultado" el valor de la consulta ya hecha:
$resultado = $conexion->query($consulta);

// Si en ese resultado, la propiedad num_rows (de mysqli) dictamina que hay al menos una fila ...
// ... entonces el if se ejecuta, dando a una nueva variable ese resultado y pasándolo a json:
if ($resultado->num_rows > 0) {
    $incidenciaEspecifica = $resultado->fetch_assoc();
    echo json_encode($incidenciaEspecifica);
// Si no es así, entonces se devuelve un objeto json vacío:     
} else {
    echo json_encode(array());
}

// Cierro la conexión:
$conexion->close();

?>



