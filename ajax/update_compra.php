<?php require_once '../conexion.php';
$con = conectar();

$id = $_POST["id"];
$producto = $_POST["producto"];
$fecha = date('Y-m-d');
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];


$actualizar_com = "UPDATE `compras` SET `fecha`='$fecha',`cantidad`='$cantidad',`precio`='$precio' WHERE id = $id";
$resultado = mysqli_query($con, $actualizar_com);
if ($resultado) {
    echo 1;
} else {
    echo 0;
}
