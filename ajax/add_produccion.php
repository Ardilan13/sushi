<?php require_once '../conexion.php';
$con = conectar();

$id = $_POST["id"];
$cantidad_pro1 = $_POST["cantidad_pro_1"];
$total = $_POST["total"];
$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$unidad = $_POST["unidad"];
$cantidad = $_POST["cantidad"];
$valor = $_POST["valor"];
$fecha = date("Y-m-d");

$crear_prod = "INSERT INTO productos(nombre, tipo, unidad, cantidad, precio) VALUES ('$nombre',$tipo,$unidad,$cantidad,$valor);";
$resultado = mysqli_query($con, $crear_prod);
if ($resultado) {
    (float)$total1 = (float)$total - (float)$cantidad_pro1;
    $actualizar_prod = "UPDATE productos SET cantidad = $total1 WHERE id = $id";
    $resultado = mysqli_query($con, $actualizar_prod);
    if ($resultado) {
        $crear_prod = "INSERT INTO movimientos(id_producto,fecha,tipo, cantidad) VALUES ('$id','$fecha',5,$cantidad_pro1);";
        $resultado1 = mysqli_query($con, $crear_prod);
        if ($resultado1) {
            $nombre_producto = "SELECT id FROM productos WHERE nombre = '$nombre';";
            $resultado4 = mysqli_query($con, $nombre_producto);
            if ($resultado4->num_rows > 0) {
                while ($row2 = mysqli_fetch_assoc($resultado4)) {
                    $id_producto = $row2['id'];
                    $crear_prod = "INSERT INTO movimientos(id_producto,fecha,tipo, cantidad) VALUES ('$id_producto','$fecha',4,$cantidad);";
                    $resultado1 = mysqli_query($con, $crear_prod);
                    if ($resultado1) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                }
            }
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}
