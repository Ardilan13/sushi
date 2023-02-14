<?php require_once '../conexion.php';
$con = conectar();

$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$proveedor = $_POST["proveedor"];
$unidad = $_POST["unidad"];
$merma = $_POST["merma"];
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];

$crear_prod = "INSERT INTO productos(nombre, tipo, proveedor, unidad, merma, cantidad, precio) VALUES ('$nombre',$tipo,'$proveedor',$unidad,$merma,$cantidad,$precio);";
$resultado = mysqli_query($con, $crear_prod);
if ($resultado) {
    echo 1;
} else {
    echo 0;
}
