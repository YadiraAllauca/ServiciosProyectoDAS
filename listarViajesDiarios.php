<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$sql = "SELECT F.*, C1.nombre_ciudad AS origen, C2.nombre_ciudad AS destino, P1.nombre_provincia AS origenProvincia, P2.nombre_provincia AS destinoProvincia, FC.*, U.id_usuario, B.*, C.*, VD.*
FROM Frecuencias AS F
JOIN Frecuencias_Cooperativas AS FC ON F.id_frecuencia = FC.id_frecuencia_asignada
JOIN Cooperativas AS C ON C.id_cooperativa = FC.id_cooperativa_pertenece
JOIN Usuarios AS U ON U.id_usuario = C.id_cooperativa
JOIN Buses AS B ON B.id_socio = U.id_usuario
JOIN Ciudades AS C1 ON C1.id_ciudad = F.origen_frecuencia
JOIN Ciudades AS C2 ON C2.id_ciudad = F.destino_frecuencia
JOIN Provincias AS P1 ON P1.id_provincia = C1.id_provincia
JOIN Provincias AS P2 ON P2.id_provincia = C2.id_provincia
JOIN Viajes_Diarios AS VD ON VD.id_asignacion_pertenece = FC.id_asignacion
GROUP BY VD.id_viaje
ORDER BY RAND()
LIMIT 20";

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
