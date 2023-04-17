<?php
require_once '../conexion.php';
$con = conectar();

$id = $_POST['id'];
$valor = $_POST['valor'];
$preparacion = $_POST['preparacion'];
$final = 0;

$sql = "DELETE FROM ingredientes WHERE id = $id";
if ($con->query($sql) === TRUE) {
    $select = "SELECT id, valor FROM preparaciones WHERE nombre = '$preparacion'";
    $resultado = mysqli_query($con, $select);
    $row1 = mysqli_fetch_assoc($resultado);
    $preparacion_id = $row1['id'];
    $valor_pre = $row1['valor'];
    (float)$final = (float)$valor_pre - (float)$valor;
    $update = "UPDATE preparaciones SET valor = '$final' WHERE id = $preparacion_id";
    $resultado = mysqli_query($con, $update);
    if ($resultado) {
        echo 1;
    } else {
        echo 0;
    }
} else {
    echo 0;
};

$con->close();
