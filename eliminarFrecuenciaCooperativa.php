<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_frecuencia_asignada = $_POST['id_frecuencia_asignada'];
$id_cooperativa_pertenece = $_POST['id_cooperativa_pertenece'];

$sql = "DELETE FROM Frecuencias_Cooperativas WHERE id_frecuencia_asignada = '$id_frecuencia_asignada' AND id_cooperativa_pertenece = '$id_cooperativa_pertenece'";

if ($conexion->query($sql) === TRUE) {
    echo json_encode(array('OK' => TRUE));
} else {
    echo json_encode(array('OK' => FALSE, 'errorMsg' => $sql . $conexion->error));
}

$conexion->close();
?>