<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$email_usuario = $_GET['email_usuario'];

$sql = "SELECT clave_usuario FROM Usuarios WHERE email_usuario = '$email_usuario'";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    
    $datosUsuario = array(
        'clave_usuario' => $fila['clave_usuario']
    );
    
    echo json_encode($datosUsuario, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(array('mensaje' => 'No se encontró el usuario'), JSON_UNESCAPED_UNICODE);
}

$conexion->close();
?>