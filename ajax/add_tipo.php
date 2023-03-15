<?php require_once '../conexion.php';
$con = conectar();

$nombre = $_POST["nombre"];
$id = isset($_POST["id"]) ? $_POST["id"] : null;

if ($id == null) {
    $crear_tipo = "INSERT INTO tipo(nombre) VALUES ('$nombre');";
    $resultado = mysqli_query($con, $crear_tipo);
    if ($resultado == 1) {
        echo 1;
    } else {
        echo 0;
    }
} else {
    $actualizar_tipo = "UPDATE `tipo` SET `nombre`='$nombre' WHERE id = $id";
    $resultado = mysqli_query($con, $actualizar_tipo);
    if ($resultado) {
        echo 1;
    } else {
        echo 0;
    }
}
