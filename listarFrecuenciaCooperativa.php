<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_cooperativa_pertenece = $_POST['id_cooperativa_pertenece'];

$sql = "SELECT F.*, C1.nombre_ciudad AS origen, C2.nombre_ciudad AS destino 
FROM Frecuencias AS F 
JOIN Ciudades AS C1 ON C1.id_ciudad = F.origen_frecuencia 
JOIN Ciudades AS C2 ON C2.id_ciudad = F.destino_frecuencia 
JOIN Frecuencias_Cooperativas AS FC ON FC.id_frecuencia_asignada = F.id_frecuencia 
JOIN Cooperativas AS C ON C.id_cooperativa = FC.id_cooperativa_pertenece 
WHERE C.id_cooperativa = '$id_cooperativa_pertenece'";

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
