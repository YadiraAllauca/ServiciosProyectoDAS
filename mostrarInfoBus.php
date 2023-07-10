<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_bus = $_POST['id_bus'];

$sql = "SELECT * FROM Buses WHERE id_bus = '$id_bus'";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    
    $datosBus = array(
        'id_bus' => $fila['id_bus'],
        'numero_bus' => $fila['numero_bus'],
        'placa_bus' => $fila['placa_bus'],
        'carroceria_bus' => $fila['carroceria_bus'],
        'cantidad_asientos' => $fila['cantidad_asientos'],
        'fotografia' => $fila['fotografia'],
        'id_socio' => $fila['id_socio'],
        'estado' => $fila['estado']
    );
    
    echo json_encode($datosBus, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(array('mensaje' => 'No se encontró el bus'), JSON_UNESCAPED_UNICODE);
}

$conexion->close();
?>
