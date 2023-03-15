<?php require_once '../conexion.php';
$con = conectar();

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$unidad = $_POST["unidad"];
$cantidad = $_POST["cantidad"];

$actualizar_pre = "UPDATE `preparaciones` SET `nombre`='$nombre',`unidad`='$unidad',`cantidad`='$cantidad' WHERE id = $id";
$resultado = mysqli_query($con, $actualizar_pre);
if ($resultado) {
    echo 1;
} else {
    echo 0;
}
