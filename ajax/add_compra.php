<?php require_once '../conexion.php';
$con = conectar();

$producto = $_POST["producto"];
$fecha = $_POST["fecha"];
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];

$crear_compra = "INSERT INTO compra(id_producto, fecha, cantidad, precio) VALUES ($producto,'$fecha',$cantidad,$precio);";
$resultado = mysqli_query($con, $crear_compra);
if ($resultado) {
    $get_producto = "SELECT cantidad FROM productos WHERE id = $producto LIMIT 1;";
    $resultado_get = mysqli_query($con, $get_producto);
    $row = mysqli_fetch_array($resultado_get);
    $total = (float)$row['cantidad'] + (float)$cantidad;
    $update_producto = "UPDATE productos SET cantidad=$total, precio=$precio WHERE id = $producto;";
    $resultado_update = mysqli_query($con, $update_producto);
    if ($resultado_update) {
        echo 1;
    }
} else {
    echo 0;
}
