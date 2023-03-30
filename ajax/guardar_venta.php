<?php require_once '../conexion.php';
$con = conectar();

$id = $_POST["id"];

$get_cuentas = "SELECT * FROM cuentas WHERE id_diario = $id;";
$resultado = mysqli_query($con, $get_cuentas);
if ($resultado) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $cantidad = $row['cantidad'];
        if ($row['tipo'] == 1) {
            $receta = $row['id_preparacion'];
            $get_receta = "SELECT * FROM ingredientes WHERE id_preparacion = $receta;";
            $resultado1 = mysqli_query($con, $get_receta);
            if ($resultado1) {
                while ($row1 = mysqli_fetch_assoc($resultado1)) {
                    if ($row1['tipo'] == 1) {
                        $preparacion = $row1['id_producto'];
                        $get_preparacion = "SELECT * FROM ingredientes WHERE id_preparacion = $preparacion;";
                        $resultado2 = mysqli_query($con, $get_preparacion);
                        if ($resultado2) {
                            while ($row2 = mysqli_fetch_assoc($resultado2)) {
                                $producto = $row2['id_producto'];
                                $cantidad_producto = $row2['cantidad'];
                                $get_producto = "SELECT cantidad FROM productos WHERE id = $producto LIMIT 1;";
                                $resultado_get = mysqli_query($con, $get_producto);
                                $row3 = mysqli_fetch_array($resultado_get);
                                $total = (float)$row3['cantidad'] - ((float)$cantidad * (float)$cantidad_producto);
                                $update_producto = "UPDATE productos SET cantidad=$total WHERE id = $producto;";
                                $resultado_update = mysqli_query($con, $update_producto);
                                if ($resultado_update) {
                                    $update_diario = "UPDATE diario SET status=1 WHERE id = $id;";
                                    $resultado_update = mysqli_query($con, $update_diario);
                                    echo 1;
                                }
                            }
                        }
                    } else {
                        $producto = $row1['id_producto'];
                        $cantidad_producto = $row1['cantidad'];
                        $get_producto = "SELECT cantidad FROM productos WHERE id = $producto LIMIT 1;";
                        $resultado_get = mysqli_query($con, $get_producto);
                        $row2 = mysqli_fetch_array($resultado_get);
                        $total = (float)$row2['cantidad'] - ((float)$cantidad * $cantidad_producto);
                        $update_producto = "UPDATE productos SET cantidad=$total WHERE id = $producto;";
                        $resultado_update = mysqli_query($con, $update_producto);
                        if ($resultado_update) {
                            echo 1;
                            $update_diario = "UPDATE diario SET status=1 WHERE id = $id;";
                            $resultado_update = mysqli_query($con, $update_diario);

                            $get_diario = "SELECT fecha FROM diario WHERE id = $id;";
                            $resultado_get = mysqli_query($con, $get_diario);
                            $row2 = mysqli_fetch_array($resultado_get);
                            $fecha = $row2['fecha'];
                            $cantidad_pro1 = (float)$cantidad;
                            $crear_prod = "INSERT INTO movimientos(id_producto,fecha,tipo, cantidad) VALUES ('$receta','$fecha',7,$cantidad_pro1);";
                            $resultado5 = mysqli_query($con, $crear_prod);
                            if ($resultado5) {
                                echo 1;
                            } else {
                                echo $crear_prod;
                            }
                        }
                    }
                }
            }
        } else {
            $producto = $row['id_preparacion'];
            $get_producto = "SELECT cantidad FROM productos WHERE id = $producto LIMIT 1;";
            $resultado_get = mysqli_query($con, $get_producto);
            $row1 = mysqli_fetch_array($resultado_get);
            $total = (float)$row1['cantidad'] - (float)$cantidad;
            $update_producto = "UPDATE productos SET cantidad=$total WHERE id = $producto;";
            $resultado_update = mysqli_query($con, $update_producto);
            if ($resultado_update) {
                echo 1;
                $update_diario = "UPDATE diario SET status=1 WHERE id = $id;";
                $resultado_update = mysqli_query($con, $update_diario);
            }
        }
    }
} else {
    echo 0;
}
