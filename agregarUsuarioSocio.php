<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$cedula_usuario = $_POST['cedula_usuario'];
$email_usuario = $_POST['email_usuario'];
$clave_usuario = $_POST['clave_usuario'];
$nombre_usuario = $_POST['nombre_usuario'];
$apellido_usuario = $_POST['apellido_usuario'];
$telefono_usuario = $_POST['telefono_usuario'];
$id_coop = $_POST['id_coop'];

$sql = "INSERT INTO Usuarios (cedula_usuario, tipo_usuario, email_usuario, clave_usuario, nombre_usuario, apellido_usuario, telefono_usuario, id_coop) VALUES ('$cedula_usuario', 'socio', '$email_usuario', '$clave_usuario', '$nombre_usuario', '$apellido_usuario', '$telefono_usuario', '$id_coop')";

if ($conexion->query($sql)===TRUE) {
    echo json_encode(array('OK'=>TRUE));
} else {
    echo json_encode(array('OK'=>FALSE, 'errorMsg'=>$sql.$conexion->error));
}

$conexion->close();
?>
