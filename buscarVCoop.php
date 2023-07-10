 <?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

  include 'conexionBDRemota.php';

  $origen =  $_GET['origen'];
  $destino =  $_GET['destino'];
  $cooperativa = $_GET['cooperativa'];

  $sql = "SELECT VD.*, C1.nombre_ciudad AS origen, C2.nombre_ciudad AS destino, P1.nombre_provincia AS origenProvincia, P2.nombre_provincia AS destinoProvincia, P.*, C.nombre_cooperativa, B.* FROM Viajes_Diarios AS VD JOIN Frecuencias_Cooperativas AS FC ON FC.id_asignacion = VD.id_asignacion_pertenece JOIN Paradas AS P ON P.id_asignacion_pertenece = VD.id_asignacion_pertenece JOIN Ciudades AS C1 ON C1.id_ciudad = P.origen_parada JOIN Ciudades AS C2 ON C2.id_ciudad = P.destino_parada JOIN Provincias AS P1 ON P1.id_provincia = C1.id_provincia JOIN Provincias AS P2 ON P2.id_provincia = C2.id_provincia JOIN Cooperativas AS C ON C.id_cooperativa = FC.id_cooperativa_pertenece JOIN Usuarios AS U ON U.id_coop = C.id_cooperativa JOIN Buses AS B ON B.id_socio = U.id_usuario WHERE C.nombre_cooperativa = '$cooperativa' AND C1.nombre_ciudad = '$origen' AND C2.nombre_ciudad = '$destino' GROUP BY P.id_parada";

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