<?php require_once '../conexion.php';
$con = conectar();

$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];

$crear_preparacion = "INSERT INTO preparaciones(nombre, tipo) VALUES ('$nombre',$tipo);";
$resultado = mysqli_query($con, $crear_preparacion);
if ($resultado) {
    echo 1;
} else {
    echo 0;
}
