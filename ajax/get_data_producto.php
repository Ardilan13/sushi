<?php require_once '../conexion.php';
$con = conectar();

$id = $_GET['id'];
$get_precio = "SELECT precio,cantidad FROM productos WHERE id = $id;";
$resultado = mysqli_query($con, $get_precio);
if ($resultado->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $lista['precio'] = number_format($row['precio'], 2);
        $lista['cantidad'] = $row['cantidad'];
    }
    echo json_encode($lista);
} else {
    echo 0;
}
