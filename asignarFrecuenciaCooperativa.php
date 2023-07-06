<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_cooperativa_pertenece = $_POST['id_cooperativa_pertenece'];
$id_frecuencia_asignada = $_POST['id_frecuencia_asignada'];

$sql = "INSERT INTO Frecuencias_Cooperativas (id_cooperativa_pertenece, id_frecuencia_asignada) VALUES ('$id_cooperativa_pertenece', '$id_frecuencia_asignada')";

if ($conexion->query($sql)===TRUE) {
    echo json_encode(array('OK'=>TRUE));
} else {
    echo json_encode(array('OK'=>FALSE, 'errorMsg'=>$sql.$conexion->error));
}

$conexion->close();
?>