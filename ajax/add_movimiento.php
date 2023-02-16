<?php require_once '../conexion.php';
$con = conectar();

$producto = $_POST["producto"];
$tipo = $_POST["tipo"];
$fecha = date('Y-m-d');
$cantidad = $_POST["cantidad"];
$motivo = $_POST["motivo"];

$crear_movimiento = "INSERT INTO movimientos(id_producto, tipo, fecha, cantidad, motivo) VALUES ($producto,$tipo,'$fecha',$cantidad,'$motivo');";
$resultado = mysqli_query($con, $crear_movimiento);
if ($resultado) {
    $get_producto = "SELECT cantidad FROM productos WHERE id = $producto LIMIT 1;";
    $resultado_get = mysqli_query($con, $get_producto);
    $row = mysqli_fetch_array($resultado_get);
    if ($tipo == 0) {
        $total = (float)$row['cantidad'] + (float)$cantidad;
    } else if ($tipo == 1) {
        $total = (float)$row['cantidad'] - (float)$cantidad;
    }
    $update_producto = "UPDATE productos SET cantidad=$total WHERE id = $producto;";
    $resultado_update = mysqli_query($con, $update_producto);
    if ($resultado_update) {
        echo 1;
    }
} else {
    echo 0;
}
