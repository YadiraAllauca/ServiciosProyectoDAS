<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_parada = $_POST['id_parada'];
$id_asignacion_pertenece = $_POST['id_asignacion_pertenece'];
$costo_parada = $_POST['costo_parada'];
$duracion_parada = $_POST['duracion_parada'];
$origen_parada = $_POST['origen_parada'];
$destino_parada = $_POST['destino_parada'];

$sql = "UPDATE Paradas SET id_asignacion_pertenece='$id_asignacion_pertenece', costo_parada='$costo_parada', duracion_parada='$duracion_parada', origen_parada='$origen_parada', destino_parada='$destino_parada' WHERE id_parada='$id_parada'";

if ($conexion->query($sql)===TRUE) {
    echo json_encode(array('OK'=>TRUE));
} else {
    echo json_encode(array('OK'=>FALSE, 'errorMsg'=>$sql.$conexion->error));
}

$conexion->close();
?>