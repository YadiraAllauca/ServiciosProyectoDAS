<?php

$databaseUnavailable = static function () {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array('errorMsg' => 'Base de datos no disponible'));
    exit;
};

$host = getenv('DB_HOST');
$dbUsuario = getenv('DB_USER');
$dbContraseña = getenv('DB_PASSWORD');
$dbNombre = getenv('DB_NAME');

foreach (array($host, $dbUsuario, $dbContraseña, $dbNombre) as $value) {
    if ($value === false || $value === '') {
        $databaseUnavailable();
    }
}

try {
    $conexion = @new mysqli($host, $dbUsuario, $dbContraseña, $dbNombre);
    if ($conexion->connect_errno) {
        $databaseUnavailable();
    }
} catch (mysqli_sql_exception $error) {
    $databaseUnavailable();
}
