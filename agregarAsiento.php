<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_asiento = $_POST['id_asiento'];
$id_bus_pertenece = $_POST['id_bus_pertenece'];
$numero_puesto = $_POST['numero_puesto'];
$estado = $_POST['estado'];
$descripcion_asiento = $_POST['descripcion_asiento'];
$costo_adicional = $_POST['costo_adicional'];

if (empty($id_asiento)) {
    $sql = "INSERT INTO Asientos (id_bus_pertenece, numero_puesto, estado, descripcion_asiento, costo_adicional) VALUES ('$id_bus_pertenece', '$numero_puesto', '$estado', '$descripcion_asiento', '$costo_adicional')";
}else{
    $sql = "UPDATE Asientos SET id_bus_pertenece='$id_bus_pertenece', numero_puesto='$numero_puesto', estado='$estado', descripcion_asiento='$descripcion_asiento', costo_adicional='$costo_adicional'  WHERE id_asiento='$id_asiento'";
}
if ($conexion->query($sql)===TRUE) {
    echo json_encode(array('OK'=>TRUE));
} else {
    echo json_encode(array('OK'=>FALSE, 'errorMsg'=>$sql.$conexion->error));
}

$conexion->close();
