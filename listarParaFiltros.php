<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$opcion = $_POST['opcion'];

if($opcion == 1){
  $sql = "SELECT * FROM Cooperativas WHERE id_cooperativa<>1";
}
else if($opcion == 2){
  $sql = "SELECT DISTINCT descripcion_asiento FROM Asientos";
}else if($opcion == 3){
  $sql = "SELECT DISTINCT chasis_bus FROM Buses";
}else{
  $sql = "SELECT DISTINCT carroceria_bus FROM Buses";
}

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
