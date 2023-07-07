<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_bus = $_POST['id_bus'];

$sql = "SELECT VD.*, C1.nombre_ciudad AS origen, C2.nombre_ciudad AS destino
FROM Viajes_Diarios AS VD 
JOIN Buses AS B ON B.id_bus = VD.id_bus_viaje
JOIN Frecuencias_Cooperativas AS FC ON FC.id_asignacion = VD.id_asignacion_pertenece
JOIN Frecuencias AS F ON F.id_frecuencia = FC.id_frecuencia_asignada
JOIN Ciudades AS C1 ON C1.id_ciudad = F.origen_frecuencia
JOIN Ciudades AS C2 ON C2.id_ciudad = F.destino_frecuencia
WHERE B.id_bus = '$id_bus'";

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
