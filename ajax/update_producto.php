<?php require_once '../conexion.php';
$con = conectar();

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$proveedor = $_POST["proveedor"];
$unidad = $_POST["unidad"];
$merma = $_POST["merma"];

$actualizar_prod = "UPDATE `productos` SET `nombre`='$nombre',`tipo`='$tipo',`proveedor`='$proveedor',`unidad`='$unidad',`merma`='$merma' WHERE id = $id";
$resultado = mysqli_query($con, $actualizar_prod);
if ($resultado) {
    echo 1;
} else {
    echo 0;
}
