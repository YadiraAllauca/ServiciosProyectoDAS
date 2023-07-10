<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, OPTIONS');

include 'conexionBDRemota.php';

$id_asignacion_pertenece = $_GET['id_asignacion_pertenece'];

$sql = "SELECT * FROM Paradas WHERE id_asignacion_pertenece = '$id_asignacion_pertenece'";

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
?>
