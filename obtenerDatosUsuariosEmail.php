<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$email_usuario = $_GET['email_usuario'];

$sql = "SELECT * FROM Usuarios WHERE email_usuario = '$email_usuario'";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    
    $datosUsuario = array(
        'id_usuario' => $fila['id_usuario'],
        'cedula_usuario' => $fila['cedula_usuario'],
        'tipo_usuario' => $fila['tipo_usuario'],
        'email_usuario' => $fila['email_usuario'],
        'clave_usuario' => $fila['clave_usuario'],
        'nombre_usuario' => $fila['nombre_usuario'],
        'apellido_usuario' => $fila['apellido_usuario'],
        'telefono_usuario' => $fila['telefono_usuario'],
        'foto_usuario' => $fila['foto_usuario']
    );
    
    echo json_encode($datosUsuario, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(array('mensaje' => 'No se encontró el usuario'), JSON_UNESCAPED_UNICODE);
}

$conexion->close();
?>