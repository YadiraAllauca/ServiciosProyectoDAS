<?php
error_reporting(E_ERROR | E_PARSE);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';


$id_cooperativa = $_POST['id_cooperativa'];
$ruc_cooperativa = $_POST['ruc_cooperativa'];
$nombre_cooperativa = $_POST['nombre_cooperativa'];
$cantidad_buses = $_POST['cantidad_buses'];
$estado = $_POST['estado'];

if (empty($id_cooperativa)) {
  $sql = "INSERT INTO Cooperativas (ruc_cooperativa, nombre_cooperativa, cantidad_buses, estado) VALUES ('$ruc_cooperativa', '$nombre_cooperativa', '$cantidad_buses', '$estado')";
}else{
  $sql = "UPDATE Cooperativas SET ruc_cooperativa = '$ruc_cooperativa', nombre_cooperativa = '$nombre_cooperativa', cantidad_buses = '$cantidad_buses', estado='$estado' WHERE id_cooperativa = $id_cooperativa";

}
if ($conexion->query($sql)===TRUE) {
    echo json_encode(array('OK'=>TRUE));
} else {
    echo json_encode(array('OK'=>FALSE, 'errorMsg'=>$sql.$conexion->error));
}

$conexion->close();
?>