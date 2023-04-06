<?php require_once '../conexion.php';
$con = conectar();

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$unidad = $_POST["unidad"];
$cantidad = $_POST["cantidad"];
$tipo = $_POST["tipo"];
$valor = $_POST["valor"] ?? null;
$fecha = $_POST["fecha"] == "" || $_POST['fecha'] == null ? date("Y-m-d") : $_POST["fecha"];

$actualizar_pre = "UPDATE `preparaciones` SET `nombre`='$nombre',`unidad`='$unidad' WHERE id = $id";
$resultado = mysqli_query($con, $actualizar_pre);
if ($resultado) {
    if ($tipo == 1 && $cantidad != 0) {
        $getproducto = "SELECT i.cantidad as preparacion,p.cantidad,p.id FROM ingredientes i INNER JOIN productos p ON i.id_producto = p.id WHERE id_preparacion = $id;";
        $resultado2 = mysqli_query($con, $getproducto);
        if ($resultado2->num_rows > 0) {
            while ($row1 = mysqli_fetch_assoc($resultado2)) {
                $id_producto = $row1['id'];
                $cantidad_producto = $row1['cantidad'];
                $cantidad_preparacion = $row1['preparacion'];
                $total = $cantidad_producto - $cantidad_preparacion;
                $update_producto = "UPDATE `productos` SET cantidad=$total WHERE id = $id_producto";
                $resultado3 = mysqli_query($con, $update_producto);
                if ($resultado3) {
                    $crear_prod = "INSERT INTO movimientos(id_producto,fecha,tipo, cantidad) VALUES ('$id_producto','$fecha',3,$cantidad_preparacion);";
                    $resultado1 = mysqli_query($con, $crear_prod);
                    if ($resultado1) {
                        echo 1;
                    } else {
                        echo $crear_prod;
                    }
                }
            }
        } else {
            echo 0;
        }
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
                        echo 1;
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
                            echo 1;
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
        echo 1;
    }
} else {
    echo 0;
}
