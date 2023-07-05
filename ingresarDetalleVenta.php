<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_venta_pertenece = $_POST['id_venta_pertenece'];
$id_asiento = $_POST['id_asiento'];
$costo_asiento = $_POST['costo_asiento'];
$costo_parada = $_POST['costo_parada'];
$cedula_pasajero = $_POST['cedula_pasajero'];

$suma = $costo_asiento + $costo_parada;

$sql = "INSERT INTO Detalle_Venta(id_venta_pertenece, id_asiento, costo_asiento, costo_parada, cedula_pasajero, total_detalle) VALUES ($id_venta_pertenece, $id_asiento, $costo_asiento, $costo_parada, '$cedula_pasajero', $suma)";

if ($conexion->query($sql)===TRUE) {
    echo json_encode(array('OK'=>TRUE));
} else {
    echo json_encode(array('OK'=>FALSE, 'errorMsg'=>$sql.$conexion->error));
}

$conexion->close();
