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

// Variable con el valor de una consulta SQL que seleccione todo de la tabla "incidencias":
$consulta = "SELECT * FROM incidencias";
// Se le da a la nueva variable "resultado" el valor de la consulta ya hecha:
$resultado = $conexion->query($consulta);

// Creo un array para almacenar todas las incidencias:
$listaDeIncidencias = array();

// Si en ese resultado, la propiedad num_rows (de mysqli) dictamina que hay al menos una fila ...
// ... entonces el if se ejecuta y entramos en el while, donde la nueva variable "nuevaFila" se crea ...
// ... dándole cada fila gracias al método fetch_assoc. Entonces se van añadiendo las filas a "listaDeIncidencias":
if ($resultado->num_rows > 0) {
    while($nuevaFila = $resultado->fetch_assoc()) {
        $listaDeIncidencias[] = $nuevaFila;
    }
}

// Se pasa la lista a json:
echo json_encode($listaDeIncidencias);

// Se cierra la conexión:
$conexion->close();

?>




