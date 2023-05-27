<?php
require_once '../conexion.php';
$con = conectar();

$id_prepa = "SELECT id FROM preparaciones";
$resultado = mysqli_query($con, $id_prepa);
while ($row = mysqli_fetch_assoc($resultado)) {
    $valor = 0;
    $get_recetas_p = "SELECT i.id,p.id as producto,i.cantidad,p.precio FROM ingredientes i INNER JOIN productos p ON i.id_producto = p.id WHERE i.id_preparacion = " . $row['id'] . ";";
    $resultado_get_rp = mysqli_query($con, $get_recetas_p);
    while ($row1 = mysqli_fetch_assoc($resultado_get_rp)) {
        $update_valor = "UPDATE ingredientes SET valor=" . $row1['precio'] . " WHERE id = " . $row1['id'] . " AND id_producto = " . $row1['producto'] . ";";
        $res_update_valor = mysqli_query($con, $update_valor);
        $valor += $row1['cantidad'] * $row1['precio'];
    }
    $update_valor = "UPDATE preparaciones SET valor=$valor WHERE id = " . $row['id'] . ";";
    $res_update_valor = mysqli_query($con, $update_valor);
}
echo 1;
