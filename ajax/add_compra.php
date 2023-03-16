<?php require_once '../conexion.php';
$con = conectar();

$producto = $_POST["producto"];
$fecha = date_create($_POST["fecha"]);
$fecha = date_format($fecha, "Y-m-d");
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];
$status = null;

$crear_compra = "INSERT INTO compra(id_producto, fecha, cantidad, precio) VALUES ($producto,'$fecha',$cantidad,$precio);";
$resultado = mysqli_query($con, $crear_compra);
if ($resultado) {
    $get_producto = "SELECT cantidad, precio FROM productos WHERE id = $producto LIMIT 1;";
    $resultado_get = mysqli_query($con, $get_producto);
    $row = mysqli_fetch_array($resultado_get);
    if ($row['precio'] > $precio) {
        $status = 0;
    } else if ($row['precio'] < $precio) {
        $status = 1;
    } else {
        $status = 2;
    }
    $total = (float)$row['cantidad'] + (float)$cantidad;
    $update_producto = "UPDATE productos SET status = $status, cantidad=$total, precio=$precio WHERE id = $producto;";
    $resultado_update = mysqli_query($con, $update_producto);
    if ($resultado_update) {
        echo 1;
    } else {
        echo $update_producto;
    }
} else {
    echo 0;
}
