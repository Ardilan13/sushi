<?php require_once '../conexion.php';
$con = conectar();

$id = $_POST["id"];
$producto = $_POST["producto"];
$total = $_POST["total1"];
$cantidad = $_POST["cantidad_new"];
$cantidad_pro_2 = $_POST["cantidad_pro_2"];
$precio = $_POST["valor"];
$fecha = date("Y-m-d");

$crear_prod = "SELECT cantidad FROM productos WHERE id = $producto;";
$resultado = mysqli_query($con, $crear_prod);
if ($resultado) {
    $row = mysqli_fetch_array($resultado);
    $cantidad1 = $row['cantidad'] + $cantidad;
    $crear_prod = "UPDATE productos SET cantidad = $cantidad1, precio = $precio WHERE id = $producto;";
    $resultado = mysqli_query($con, $crear_prod);
    if ($resultado) {
        $crear_prod = "INSERT INTO movimientos(id_producto,fecha,tipo, cantidad) VALUES ('$producto','$fecha',4,$cantidad);";
        $resultado1 = mysqli_query($con, $crear_prod);
        if ($resultado1) {
            (float)$total1 = (float)$total - (float)$cantidad_pro_2;
            $actualizar_prod = "UPDATE productos SET cantidad = $total1 WHERE id = $id";
            $resultado = mysqli_query($con, $actualizar_prod);
            if ($resultado) {
                $crear_prod = "INSERT INTO movimientos(id_producto,fecha,tipo, cantidad) VALUES ('$id','$fecha',5,$cantidad_pro_2);";
                $resultado1 = mysqli_query($con, $crear_prod);
                if ($resultado1) {
                    echo 1;
                }
            } else {
                echo 0;
            }
        }
    } else {
        echo 0;
    }
}
