<?php
session_start();
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$email_usuario = mysqli_real_escape_string($conexion, $_POST['email_usuario']);
$clave_usuario = mysqli_real_escape_string($conexion, $_POST['clave_usuario']);
$_SESSION['user'] = $email_usuario;

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sqlQuery = $conexion->prepare("SELECT * FROM Usuarios WHERE email_usuario = ? AND clave_usuario = ?");
$sqlQuery->bind_param('ss', $email_usuario, $clave_usuario);
$sqlQuery->execute();
$resultado = $sqlQuery->get_result();

if ($fila = $resultado->fetch_assoc()) {
    $datosUsuario = array(
        'id_usuario' => $fila['id_usuario'],
        'tipo_usuario' => $fila['tipo_usuario'],
        'id_coop' => $fila['id_coop']
    );
    echo json_encode($datosUsuario, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(array('mensaje' => 'Error en la autenticación'), JSON_UNESCAPED_UNICODE);
}

mysqli_free_result($resultado);
$sqlQuery->close();
$conexion->close();
?>