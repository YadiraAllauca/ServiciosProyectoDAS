<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_usuario =  $_POST['id_usuario'];
$email_usuario = $_POST['email_usuario'];
$nombre_usuario = $_POST['nombre_usuario'];
$apellido_usuario = $_POST['apellido_usuario'];
$telefono_usuario = $_POST['telefono_usuario'];

$sql = "UPDATE Usuarios SET email_usuario='$email_usuario', nombre_usuario='$nombre_usuario', apellido_usuario='$apellido_usuario', telefono_usuario='$telefono_usuario' WHERE id_usuario='$id_usuario'";

if ($conexion->query($sql)===TRUE) {
    echo json_encode(array('OK'=>TRUE));
} else {
    echo json_encode(array('OK'=>FALSE, 'errorMsg'=>$sql.$conexion->error));
}

$conexion->close();
?>