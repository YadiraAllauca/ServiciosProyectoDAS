<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_viaje_pertenece = $_POST['id_viaje_pertenece'];

$sql = "SELECT * FROM Detalle_Venta WHERE id_venta_pertenece IN (SELECT id_venta FROM Ventas WHERE id_viaje_pertenece = '$id_viaje_pertenece')";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $lista = array();

    while ($fila = $resultado->fetch_assoc()) {
        $lista[] = $fila;
    }

    $json = json_encode($lista, JSON_UNESCAPED_UNICODE);

    echo $json;
} else {
    echo json_encode(array('mensaje' => 'No se encontraron registros de buses asociados a la cooperativa'));
}

$conexion->close();
?>
