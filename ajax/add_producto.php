<?php require_once '../conexion.php';
$con = conectar();

$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$proveedor = $_POST["proveedor"];
$unidad = $_POST["unidad"];
$merma = $_POST["merma"];
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];
$fecha = date("Y-m-d");

$crear_prod = "INSERT INTO productos(nombre, tipo, proveedor, unidad, merma, cantidad, precio) VALUES ('$nombre',$tipo,'$proveedor',$unidad,$merma,$cantidad,$precio);";
$resultado = mysqli_query($con, $crear_prod);
if ($resultado) {
    $get_prod = "SELECT id FROM productos ORDER BY id DESC LIMIT 1;";
    $resultado1 = mysqli_query($con, $get_prod);
    if ($resultado1) {
        $row = mysqli_fetch_assoc($resultado1);
        $id_producto = $row["id"];
        $crear_mov = "INSERT INTO movimientos(id_producto,fecha,tipo, cantidad) VALUES ('$id_producto','$fecha',6,$cantidad);";
        $resultado2 = mysqli_query($con, $crear_mov);
        if ($resultado2) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}
