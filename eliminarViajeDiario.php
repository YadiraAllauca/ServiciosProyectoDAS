<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_viaje = $_POST['id_viaje'];

$sql = "DELETE FROM Viajes_Diarios WHERE id_viaje = '$id_viaje'";

if ($conexion->query($sql) === TRUE) {
    echo json_encode(array('OK' => TRUE));
} else {
    echo json_encode(array('OK' => FALSE, 'errorMsg' => $sql . $conexion->error));
}

$conexion->close();
