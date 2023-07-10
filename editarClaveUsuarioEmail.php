<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$email_usuario =  $_POST['email_usuario'];
$clave_usuario = $_POST['clave_usuario'];

$sql = "UPDATE Usuarios SET clave_usuario='$clave_usuario' WHERE email_usuario='$email_usuario'";

if ($conexion->query($sql) === TRUE) {
  echo json_encode(array('OK' => TRUE));
} else {
  echo json_encode(array('OK' => FALSE, 'errorMsg' => $sql . $conexion->error));
}

$conexion->close();