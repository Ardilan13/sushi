<?php require_once '../conexion.php';
$con = conectar();

$id = $_POST['producto'];
$tipo = $_POST['tipo'];
$cantidad = $_POST['cantidad'];
$get_cantidad = "SELECT cantidad FROM productos WHERE id = $id;";
$resultado = mysqli_query($con, $get_cantidad);
if ($resultado->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        if ($cantidad <= $row['cantidad'] || $tipo == 0) {
            echo 1;
        } else {
            echo number_format($row['cantidad'], 1);
        }
    }
} else {
    echo 0;
}
