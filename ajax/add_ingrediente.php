<?php require_once '../conexion.php';
$con = conectar();

$id = $_POST["id"];
$producto = isset($_POST["producto"]) ? $_POST["producto"] : null;
$preparacion = isset($_POST["preparacion"]) ? $_POST["preparacion"] : null;
$cantidad = $_POST["cantidad"];
$valor = $_POST["valor"];

if ($producto != null) {
    $crear_ingrediente = "INSERT INTO ingredientes(tipo, id_preparacion, id_producto, cantidad, valor) VALUES (0,$id,$producto,$cantidad,$valor);";
    $resultado = mysqli_query($con, $crear_ingrediente);
    if ($resultado) {
        $get_preparacion = "SELECT valor FROM preparaciones WHERE id = $id LIMIT 1;";
        $resultado_get = mysqli_query($con, $get_preparacion);
        $row = mysqli_fetch_array($resultado_get);
        $total = (float)$row['valor'] + (float)$valor;
        $update_preparacion = "UPDATE preparaciones SET valor=$total WHERE id = $id;";
        $resultado_update = mysqli_query($con, $update_preparacion);
        if ($resultado_update) {
            echo 1;
        }
    } else {
        echo 0;
    }
} else {
    $crear_ingrediente = "INSERT INTO ingredientes(tipo, id_preparacion, id_producto, cantidad, valor) VALUES (1,$id,$preparacion,$cantidad,$valor);";
    $resultado = mysqli_query($con, $crear_ingrediente);
    if ($resultado) {
        $get_preparacion = "SELECT valor FROM preparaciones WHERE id = $id LIMIT 1;";
        $resultado_get = mysqli_query($con, $get_preparacion);
        $row = mysqli_fetch_array($resultado_get);
        $total = (float)$row['valor'] + (float)$valor;
        $update_preparacion = "UPDATE preparaciones SET valor=$total WHERE id = $id;";
        $resultado_update = mysqli_query($con, $update_preparacion);
        if ($resultado_update) {
            echo 1;
        }
    } else {
        echo 0;
    }
}
