<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_bus_pertenece =  $_POST['id_bus_pertenece'];
$numero_puesto =  $_POST['numero_puesto'];

$sql = "SELECT COUNT(*) as count FROM Asientos WHERE id_bus_pertenece = '$id_bus_pertenece' AND numero_puesto = '$numero_puesto'";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $count = $row['count'];

    if ($count > 0) {
        echo json_encode(array('OK' => TRUE));
    } else {
        echo json_encode(array('OK' => FALSE));
    }
} else {
    echo json_encode(array('OK' => FALSE));
}

$conexion->close();
