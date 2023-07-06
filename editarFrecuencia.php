<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_frecuencia =  $_POST['id_frecuencia'];
$tipo_frecuencia = $_POST['tipo_frecuencia'];
$estado_frecuencia = $_POST['estado_frecuencia'];

$sql = "UPDATE Frecuencias SET tipo_frecuencia='$tipo_frecuencia', estado_frecuencia='$estado_frecuencia' WHERE id_frecuencia='$id_frecuencia'";

if ($conexion->query($sql)===TRUE) {
    echo json_encode(array('OK'=>TRUE));
} else {
    echo json_encode(array('OK'=>FALSE, 'errorMsg'=>$sql.$conexion->error));
}

$conexion->close();
?>