<?php

$host = "localhost";
$dbUsuario = "id20780986_gcode"; 
$dbContraseña = "gcodeDAS1."; 
$dbNombre = "id20780986_proyecto_buses_das";

$conexion = new mysqli($host, $dbUsuario, $dbContraseña, $dbNombre);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}else{

}

?>