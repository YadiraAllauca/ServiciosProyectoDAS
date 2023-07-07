<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_viaje =  $_POST['id_viaje'];
$id_asignacion_pertenece = $_POST['id_asignacion_pertenece'];
$id_bus_viaje = $_POST['id_bus_viaje'];
$fecha_viaje = $_POST['fecha_viaje'];
$hora_salida_viaje = $_POST['hora_salida_viaje'];
$hora_llegada_viaje = $_POST['hora_llegada_viaje'];

if (empty($id_viaje)) {
$sql = "INSERT INTO Viajes_Diarios (id_asignacion_pertenece, id_bus_viaje, fecha_viaje, hora_salida_viaje, hora_llegada_viaje) VALUES ('$id_asignacion_pertenece', '$id_bus_viaje', '$fecha_viaje', '$hora_salida_viaje', '$hora_llegada_viaje')";
} else{
$sql = "UPDATE Viajes_Diarios SET id_bus_viaje=$id_bus_viaje, id_asignacion_pertenece=$id_asignacion_pertenece, fecha_viaje='$fecha_viaje', hora_salida_viaje='$hora_salida_viaje', hora_llegada_viaje='$hora_llegada_viaje' WHERE id_viaje=$id_viaje";
}
if ($conexion->query($sql) === TRUE) {
    echo json_encode(array('OK' => TRUE));
} else {
    echo json_encode(array('OK' => FALSE, 'errorMsg' => $sql . $conexion->error));
}

$conexion->close();
