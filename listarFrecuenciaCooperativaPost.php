<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_cooperativa_pertenece = $_POST['id_cooperativa_pertenece'];

$sql = "SELECT * FROM Frecuencias WHERE id_frecuencia IN(SELECT id_frecuencia_asignada FROM Frecuencias_Cooperativas WHERE id_cooperativa_pertenece='$id_cooperativa_pertenece')";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $lista = array();

    while ($fila = $resultado->fetch_assoc()) {
        $lista[] = $fila;
    }

    $json = json_encode($lista, JSON_UNESCAPED_UNICODE);

    echo $json;
} 

$conexion->close();
?>