<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, OPTIONS');

include 'conexionBDRemota.php';

$id_bus = $_GET['id_bus'];
$id_viaje = $_GET['id_viaje'];

$sql = "SELECT DISTINCT A.descripcion_asiento, A.costo_adicional, P.costo_parada
FROM Asientos AS A, Paradas AS P, Viajes_Diarios AS VD, Buses AS B
WHERE B.id_bus = A.id_bus_pertenece
AND VD.id_bus_viaje = B.id_bus
AND B.id_bus= '$id_bus' AND VD.id_viaje = '$id_viaje'
GROUP BY A.descripcion_asiento";

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