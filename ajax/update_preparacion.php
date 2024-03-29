<?php require_once '../conexion.php';
$con = conectar();

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$unidad = $_POST["unidad"];
$cantidad = $_POST["cantidad"];
$tipo = $_POST["tipo"];
$valor = $_POST["valor"] ?? null;
if (isset($_POST["fecha"])) {
    $fecha = $_POST["fecha"];
}

$venta = 0;
$productos = array();
$inventario = array();

$actualizar_pre = "UPDATE `preparaciones` SET `nombre`='$nombre',`unidad`='$unidad' WHERE id = $id";
$resultado = mysqli_query($con, $actualizar_pre);
if ($resultado) {
    if ($tipo == 1 && $cantidad > 0 && $fecha != null) {
        $getproducto = "SELECT i.cantidad as preparacion,p.cantidad,p.id,p.nombre FROM ingredientes i INNER JOIN productos p ON i.id_producto = p.id WHERE id_preparacion = $id;";
        $resultado2 = mysqli_query($con, $getproducto);
        if ($resultado2->num_rows > 0) {
            while ($row1 = mysqli_fetch_assoc($resultado2)) {
                $id_producto = $row1['id'];
                $cantidad_producto = $row1['cantidad'];
                $cantidad_preparacion = $row1['preparacion'];
                $total = $cantidad_producto - $cantidad_preparacion;
                if ($total < 0) {
                    $venta = 1;
                    array_push($productos, $row1['nombre']);
                } else {
                    if (isset($inventario[$id_producto])) {
                        $inventario[$id_producto] = (float)$inventario[$id_producto] - (float)$cantidad_preparacion;
                        if ($inventario[$id_producto] < 0) {
                            $venta = 1;
                            array_push($productos, $row1['nombre']);
                        }
                    } else {
                        $inventario[$id_producto] = $total;
                    }
                    $crear_prod = "INSERT INTO movimientos(id_producto,fecha,tipo, cantidad) VALUES ('$id_producto','$fecha',3,$cantidad_preparacion);";
                    $resultado1 = mysqli_query($con, $crear_prod);
                }
            }

            if ($venta == 0) {
                foreach ($inventario as $key => $value) {
                    $update_producto = "UPDATE productos SET cantidad=$value WHERE id = $key;";
                    $resultado_update = mysqli_query($con, $update_producto);
                }
                echo "Preparacion generada correctamente.";

                $nombre_producto = "SELECT id,cantidad,precio FROM productos WHERE nombre = '$nombre' LIMIT 1;";
                $resultado4 = mysqli_query($con, $nombre_producto);
                if ($resultado4->num_rows > 0) {
                    while ($row2 = mysqli_fetch_assoc($resultado4)) {
                        $id_pro = $row2['id'];
                        $cantidad_pro = $row2['cantidad'];
                        $precio_pro = $row2['precio'];
                        $total = $cantidad_pro + $cantidad;
                        $precio_total = (($precio_pro * $cantidad_pro) + $valor) / $total;
                        $crear_prod = "UPDATE `productos` SET cantidad=$total,precio='$precio_total' WHERE id = $id_pro";
                        $resultado1 = mysqli_query($con, $crear_prod);
                        if ($resultado1) {
                            $crear_prod = "INSERT INTO movimientos(id_producto,fecha,tipo, cantidad) VALUES ('$id_pro','$fecha',2,$cantidad);";
                            $resultado1 = mysqli_query($con, $crear_prod);
                            if ($resultado1) {
                                echo null;
                            } else {
                                echo $crear_prod;
                            }
                        } else {
                            echo $nombre_producto;
                        }
                    }
                } else {
                    $valor_pro = $valor / $cantidad;
                    $crear_prod = "INSERT INTO productos(nombre,tipo, unidad, cantidad, precio) VALUES ('$nombre',0,$unidad,$cantidad,$valor_pro);";
                    $resultado1 = mysqli_query($con, $crear_prod);
                    if ($resultado1) {
                        $nombre_producto = "SELECT id,cantidad FROM productos WHERE nombre = '$nombre' ORDER BY id DESC LIMIT 1;";
                        $resultado5 = mysqli_query($con, $nombre_producto);
                        if ($resultado5->num_rows > 0) {
                            while ($row4 = mysqli_fetch_assoc($resultado5)) {
                                $id_pro = $row4['id'];
                                $cantidad_pro = $row4['cantidad'];
                                $crear_prod = "INSERT INTO movimientos(id_producto,fecha,tipo, cantidad) VALUES ('$id_pro','$fecha',2,$cantidad);";
                                $resultado1 = mysqli_query($con, $crear_prod);
                                if ($resultado1) {
                                    echo null;
                                } else {
                                    echo $crear_prod;
                                }
                            }
                        } else {
                            echo $nombre_producto;
                        }
                    } else {
                        echo $crear_prod;
                    }
                }
            } else {
                echo "Los siguientes productos son insuficientes:";
                foreach ($productos as $producto) {
                    echo $producto . ', ';
                }
            }
        } else {
            echo 0;
        }
    } else {
        echo 1;
    }
} else {
    echo 0;
}
