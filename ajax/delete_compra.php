<?php
require_once '../conexion.php';
$con = conectar();

$id = $_POST['id'];

$get_compra = "SELECT * FROM compra WHERE id = $id;";
$resultado = mysqli_query($con, $get_compra);
if ($resultado) {
    $row = mysqli_fetch_assoc($resultado);
    $producto = $row['id_producto'];
    $cantidad_compra = $row['cantidad'];
    $get_producto = "SELECT cantidad FROM productos WHERE id = $producto;";
    $resultado1 = mysqli_query($con, $get_producto);
    if ($resultado1) {
        $row1 = mysqli_fetch_assoc($resultado1);
        $cantidad_producto = $row1['cantidad'];
        $total = $cantidad_producto - $cantidad_compra;
        $actualizar_producto = "UPDATE `productos` SET `cantidad`='$total' WHERE id = $producto";
        $resultado2 = mysqli_query($con, $actualizar_producto);
        if ($resultado2) {
            $sql = "DELETE FROM compra WHERE id = $id";
            if ($con->query($sql) === TRUE) {
                echo 1;
            } else {
                echo 0;
            };
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}
$con->close();
