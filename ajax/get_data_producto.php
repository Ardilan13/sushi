<?php require_once '../conexion.php';
$con = conectar();

$id = $_GET['id'];
$get_precio = "SELECT precio,cantidad,merma FROM productos WHERE id = $id ORDER BY nombre ASC;";
$resultado = mysqli_query($con, $get_precio);
if ($resultado->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $lista['precio'] = number_format($row['precio'], 3);
        $lista['real'] = number_format($row["precio"] + $row["precio"] * ($row["merma"] / 100), 3);
        $lista['valor'] = $row['precio'];
        $lista['cantidad'] = $row['cantidad'];
    }
    echo json_encode($lista);
} else {
    echo 0;
}
