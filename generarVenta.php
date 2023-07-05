<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_comprador= $_POST['id_comprador'];
$id_viaje_pertenece = $_POST['id_viaje_pertenece'];
$id_parada_pertenece = $_POST['id_parada_pertenece'];
$fecha_venta = $_POST['fecha_venta'];
$id_forma_pago = $_POST['id_forma_pago'];
$total_venta = $_POST['total_venta'];
$codigo_qr_venta = $_POST['codigo_qr_venta'];
$comprobante_venta = $_POST['comprobante_venta'];

$sql = "INSERT INTO Ventas(id_comprador, id_viaje_pertenece, id_parada_pertenece, fecha_venta, id_forma_pago, estado_venta, total_venta, codigo_qr_venta, comprobante_venta) VALUES
($id_comprador, $id_viaje_pertenece, $id_parada_pertenece, '$fecha_venta', $id_forma_pago, 0,$total_venta, '$codigo_qr_venta', '$comprobante_venta')";

if ($conexion->query($sql)===TRUE) {
    echo json_encode(array('OK'=>TRUE));
} else {
    echo json_encode(array('OK'=>FALSE, 'errorMsg'=>$sql.$conexion->error));
}

$conexion->close();
