<?php require_once '../conexion.php';
$con = conectar();

$id = $_GET['id'];
$get_precio = "SELECT valor,cantidad FROM preparaciones WHERE id = $id;";
$resultado = mysqli_query($con, $get_precio);
if ($resultado->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $lista['valor'] = $row['valor'];
        $lista['cantidad'] = $row['cantidad'];
    }
    echo json_encode($lista);
} else {
    echo 0;
}
