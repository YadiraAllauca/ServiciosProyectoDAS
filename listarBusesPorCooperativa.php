<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, OPTIONS');

include 'conexionBDRemota.php';

$id_coop = $_GET['id_coop'];

$sql = "SELECT * FROM Buses WHERE id_socio IN (SELECT id_usuario FROM Usuarios WHERE id_coop = '$id_coop')";

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

