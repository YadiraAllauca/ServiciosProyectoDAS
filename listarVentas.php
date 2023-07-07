<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_cooperativa = $_POST['id_cooperativa'];

$sql = "SELECT V.*, U.*, VD.*, P.*, C1.nombre_ciudad AS origen, C2.nombre_ciudad AS destino
FROM Ventas AS V
JOIN Usuarios AS U ON U.id_usuario = V.id_comprador
JOIN Viajes_Diarios AS VD ON VD.id_viaje = V.id_viaje_pertenece
JOIN Paradas AS P ON P.id_parada = V.id_parada_pertenece
JOIN Ciudades AS C1 ON C1.id_ciudad = P.origen_parada
JOIN Ciudades AS C2 ON C2.id_ciudad = P.destino_parada
JOIN Frecuencias_Cooperativas AS FC ON FC.id_asignacion = P.id_asignacion_pertenece
JOIN Cooperativas AS C ON C.id_cooperativa = FC.id_cooperativa_pertenece
WHERE C.id_cooperativa = '$id_cooperativa'";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
  $lista = array();

  while ($fila = $resultado->fetch_assoc()) {
    $lista[] = $fila;
  }

  $json = json_encode($lista, JSON_UNESCAPED_UNICODE);

  echo $json;
} else {

  echo json_encode(array('mensaje' => 'No se encontraron registros'));
}

$conexion->close();
