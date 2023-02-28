<?php require_once '../conexion.php';
$con = conectar();

$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$unidad = $_POST["unidad"];

$crear_preparacion = "INSERT INTO preparaciones(nombre, tipo, unidad) VALUES ('$nombre',$tipo, $unidad);";
$resultado = mysqli_query($con, $crear_preparacion);
if ($resultado == 1) {
    echo 1;
} else {
    echo 0;
}
