<?php require_once '../conexion.php';
$con = conectar();

$id = $_POST["id"];
$cantidad_pro1 = $_POST["cantidad_pro_1"];
$total = $_POST["total"];
$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$unidad = $_POST["unidad"];
$cantidad = $_POST["cantidad"];

$crear_prod = "INSERT INTO productos(nombre, tipo, unidad, cantidad) VALUES ('$nombre',$tipo,$unidad,$cantidad);";
$resultado = mysqli_query($con, $crear_prod);
if ($resultado) {
    (float)$total1 = (float)$total - (float)$cantidad_pro1;
    $actualizar_prod = "UPDATE productos SET cantidad = $total1 WHERE id = $id";
    $resultado = mysqli_query($con, $actualizar_prod);
    if ($resultado) {
        echo 1;
    } else {
        echo 2;
    }
} else {
    echo (string)$con->connect_error;
}
