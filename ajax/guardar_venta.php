<?php require_once '../conexion.php';
$con = conectar();

$id = $_POST["id"];
$venta = 0;
$productos = array();
$inventario = array();
$recetas = array();

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
                    $producto = $row1['id_producto'];
                    $cantidad_producto = $row1['cantidad'];
                    $get_producto = "SELECT nombre,cantidad FROM productos WHERE id = $producto LIMIT 1;";
                    $resultado_get = mysqli_query($con, $get_producto);
                    $row2 = mysqli_fetch_array($resultado_get);
                    $total = (float)$row2['cantidad'] - ((float)$cantidad * $cantidad_producto);
                    if ($total < 0) {
                        $venta = 1;
                        array_push($productos, $row2['nombre']);
                    } else {
                        if (isset($inventario[$producto])) {
                            $inventario[$producto] = (float)$inventario[$producto] - ((float)$cantidad * (float)$cantidad_producto);
                            if ($inventario[$producto] < 0) {
                                $venta = 1;
                                array_push($productos, $row2['nombre']);
                            }
                        } else {
                            $inventario[$producto] = $total;
                        }
                        $recetas[$receta] = $cantidad;
                    }
                }
            }
        } else {
            $producto = $row['id_preparacion'];
            $get_producto = "SELECT nombre,cantidad FROM productos WHERE id = $producto LIMIT 1;";
            $resultado_get = mysqli_query($con, $get_producto);
            $row1 = mysqli_fetch_array($resultado_get);
            $total = (float)$row1['cantidad'] - (float)$cantidad;
            if ($total < 0) {
                $venta = 1;
                array_push($productos, $row1['nombre']);
            } else {
                if (isset($inventario[$producto])) {
                    $inventario[$producto] = (float)$inventario[$producto] - ((float)$cantidad * (float)$cantidad_producto);
                    if ($inventario[$producto] < 0) {
                        $venta = 1;
                        array_push($productos, $row1['nombre']);
                    }
                } else {
                    $inventario[$producto] = $total;
                }
            }
        }
    }
} else {
    echo 0;
}
if ($venta == 0) {
    foreach ($inventario as $key => $value) {
        $update_producto = "UPDATE productos SET cantidad=$value WHERE id = $key;";
        $resultado_update = mysqli_query($con, $update_producto);
    }

    $get_diario = "SELECT fecha FROM diario WHERE id = $id;";
    $resultado_get = mysqli_query($con, $get_diario);
    $row2 = mysqli_fetch_array($resultado_get);
    $fecha = $row2['fecha'];

    foreach ($recetas as $key => $value) {
        $crear_prod = "INSERT INTO movimientos(id_producto,fecha,tipo, cantidad) VALUES ('$key','$fecha',7,$value);";
        $resultado5 = mysqli_query($con, $crear_prod);
    }

    $update_diario = "UPDATE diario SET status=1 WHERE id = $id;";
    $resultado_update = mysqli_query($con, $update_diario);
    if ($resultado_update) {
        echo 1;
    }
} else {
    echo "Los siguientes productos son insuficientes:";
    foreach ($productos as $producto) {
        echo $producto . ', ';
    }
}
