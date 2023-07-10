<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-type, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include 'conexionBDRemota.php';

$id_comprador = $_POST['id_comprador'];
$id_viaje_pertenece = $_POST['id_viaje_pertenece'];
$id_parada_pertenece = $_POST['id_parada_pertenece'];
$fecha_venta = $_POST['fecha_venta'];
$id_forma_pago = $_POST['id_forma_pago'];
$total_venta = $_POST['total_venta'];
$codigo_qr_venta = $_POST['codigo_qr_venta'];
$comprobante_venta = $_POST['comprobante_venta'];

$sql = "INSERT INTO Ventas(id_comprador, id_viaje_pertenece, id_parada_pertenece, fecha_venta, id_forma_pago, estado_venta, total_venta, codigo_qr_venta, comprobante_venta) VALUES
('$id_comprador', '$id_viaje_pertenece', '$id_parada_pertenece', '$fecha_venta', '$id_forma_pago', 0, '$total_venta', '$codigo_qr_venta', '$comprobante_venta')";

if ($conexion->query($sql) === TRUE) {
    $id_compra_generada = $conexion->insert_id;
    
    // Obtener el objeto insertado
    $sqlQuery = "SELECT * FROM Ventas WHERE id_venta = $id_compra_generada";
    $resultado = $conexion->query($sqlQuery);
    
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        echo json_encode($fila);
    } else {
        echo json_encode(array('errorMsg' => 'No se encontró el objeto insertado'));
    }
} else {
    echo json_encode(array('errorMsg' => $sql . $conexion->error));
}

$conexion->close();
?>
