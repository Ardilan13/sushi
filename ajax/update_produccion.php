<?php require_once '../conexion.php';
$con = conectar();

$id = $_POST["id"];
$producto = $_POST["producto"];
$total = $_POST["total1"];
$cantidad_pro_2 = $_POST["cantidad_pro_2"];

$crear_prod = "UPDATE productos SET cantidad = $cantidad_pro_2 WHERE id = $producto;";
$resultado = mysqli_query($con, $crear_prod);
if ($resultado) {
    (float)$total1 = (float)$total - (float)$cantidad_pro_2;
    $actualizar_prod = "UPDATE productos SET cantidad = $total1 WHERE id = $id";
    $resultado = mysqli_query($con, $actualizar_prod);
    if ($resultado) {
        echo 1;
    } else {
        echo 0;
    }
} else {
    echo 0;
}
