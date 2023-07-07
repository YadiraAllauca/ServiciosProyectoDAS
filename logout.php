<?php
session_start();
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

// Verificamos si el usuario ha iniciado sesión
if (isset($_SESSION['user'])) {
    // Destruimos la sesión y eliminamos todas las variables de sesión
    session_unset();
    session_destroy();
    
    echo json_encode(array('mensaje' => 'Logout exitoso'), JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(array('mensaje' => 'No hay sesión activa'), JSON_UNESCAPED_UNICODE);
}
