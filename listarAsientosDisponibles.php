<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_bus_pertenece =  $_POST['id_bus_pertenece'];
$descripcion_asiento =  $_POST['descripcion_asiento'];

$sql = "SELECT * FROM Asientos WHERE id_bus_pertenece = '$id_bus_pertenece' AND descripcion_asiento='$descripcion_asiento' AND estado=1";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $lista = array();

    while ($fila = $resultado->fetch_assoc()) {
        $lista[] = $fila;
    }

    $json = json_encode($lista, JSON_UNESCAPED_UNICODE);

    echo $json;
} else {

    echo json_encode(array('mensaje' => 'No se encontraron registros en la tabla'));
}
$conexion->close();
