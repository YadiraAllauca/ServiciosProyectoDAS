<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_cooperativa = $_GET['id_cooperativa'];

$sql = "SELECT * FROM Usuarios WHERE id_coop IN(SELECT id_cooperativa FROM Cooperativas WHERE id_cooperativa='$id_cooperativa') AND tipo_usuario='socio'";

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