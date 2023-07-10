<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_bus =  $_POST['id_bus'];
$numero_bus =  $_POST['numero_bus'];
$placa_bus =  $_POST['placa_bus'];
$carroceria_bus = $_POST['carroceria_bus'];
$cantidad_asientos = $_POST['cantidad_asientos'];
$fotografia = $_POST['fotografia'];
$id_socio = $_POST['id_socio'];
$estado = $_POST['estado'];
$chasis_bus = $_POST['chasis_bus'];

if (empty($id_bus)) {
$sql = "INSERT INTO Buses (numero_bus, placa_bus, carroceria_bus, cantidad_asientos, fotografia, id_socio, estado, chasis_bus) VALUES ('$numero_bus', '$placa_bus', '$carroceria_bus','$cantidad_asientos', '$fotografia', '$id_socio', '$estado', '$chasis_bus')";
}else{
    $sql = "UPDATE Buses SET numero_bus='$numero_bus', placa_bus='$placa_bus', carroceria_bus='$carroceria_bus', cantidad_asientos='$cantidad_asientos', fotografia='$fotografia', id_socio='$id_socio', estado=$estado, chasis_bus='$chasis_bus'  WHERE id_bus='$id_bus'";
}
if ($conexion->query($sql)===TRUE) {
    echo json_encode(array('OK'=>TRUE));
} else {
    echo json_encode(array('OK'=>FALSE, 'errorMsg'=>$sql.$conexion->error));
}

$conexion->close();
?>