<?php
require_once '../conexion.php';
$con = conectar();

$id = $_POST['id'];

$get_cuenta = "SELECT * FROM cuentas WHERE id = $id;";
$resultado = mysqli_query($con, $get_cuenta);
if ($resultado) {
    $row = mysqli_fetch_assoc($resultado);
    $total = $row['cantidad'] * $row['valor'];
    $diario = $row['id_diario'];
    $get_diario = "SELECT valor FROM diario WHERE id = $diario;";
    $resultado1 = mysqli_query($con, $get_diario);
    if ($resultado1) {
        $row1 = mysqli_fetch_assoc($resultado1);
        $valor_diario = $row1['valor'] - $total;
        $actualizar_diario = "UPDATE `diario` SET `valor`='$valor_diario' WHERE id = $diario";
        $resultado2 = mysqli_query($con, $actualizar_diario);
        if ($resultado2) {
            $sql = "DELETE FROM cuentas WHERE id = $id";
            if ($con->query($sql) === TRUE) {
                echo 1;
            } else {
                echo 0;
            };
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}
$con->close();
