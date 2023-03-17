<?php require_once '../conexion.php';
$con = conectar();

$ingrediente = $_POST['ingrediente'];
$cantidad = $_POST['cantidad'];
$valor = $_POST['valor'];
$preparacion = $_POST['preparacion'];
$nuevo_valor = 0;

$total = $cantidad * $valor;
$actualizar_prod = "UPDATE ingredientes SET valor=$valor,cantidad=$cantidad WHERE id = $ingrediente";
$resultado = mysqli_query($con, $actualizar_prod);
if ($resultado) {
    $get_preparacion = "SELECT valor,cantidad from ingredientes WHERE id_preparacion = $preparacion;";
    $resultado1 = mysqli_query($con, $get_preparacion);
    if ($resultado1) {
        while ($row1 = mysqli_fetch_assoc($resultado1)) {
            $nuevo_valor = $nuevo_valor + ($row1['valor'] * $row1['cantidad']);
        }
        $actualizar_prod = "UPDATE preparaciones SET valor=$nuevo_valor WHERE id = $preparacion";
        $resultado = mysqli_query($con, $actualizar_prod);
        if ($resultado) {
            echo 1;
        }
    }
} else {
    echo 0;
}
