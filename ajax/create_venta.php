<?php require_once '../conexion.php';
$con = conectar();

$id = isset($_POST["id"]) ? $_POST["id"] : null;
$producto = isset($_POST["producto"]) ? $_POST["producto"] : null;
$receta = isset($_POST["receta"]) ? $_POST["receta"] : null;
$check_producto = 0;

if ($id == null) {
    $fecha = date_create($_POST["fecha"]);
    $fecha = date_format($fecha, "Y-m-d");
    $crear_venta = "INSERT INTO diario(fecha) VALUES ('$fecha');";
    $resultado = mysqli_query($con, $crear_venta);
    if ($resultado) {
        $get_venta = "SELECT * FROM diario WHERE fecha = '$fecha' ORDER BY id DESC LIMIT 1;";
        $resultado_get = mysqli_query($con, $get_venta);
        $row = mysqli_fetch_array($resultado_get);
        echo $row['id'];
    } else {
        echo 0;
    }
} else if ($producto != null) {
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["valor"];

    $check_prodcuto = "SELECT p.nombre,p.cantidad as inventario,c.cantidad FROM cuentas c INNER JOIN productos p ON c.id_preparacion = p.id WHERE c.id_diario = $id AND c.tipo = 0 AND c.id_preparacion = $producto;";
    $resultado2 = mysqli_query($con, $check_prodcuto);
    if ($resultado2->num_rows > 0) {
        while ($row2 = mysqli_fetch_assoc($resultado2)) {
            $nombre_real_producto = $row2['nombre'];
            $cantidad_real_producto = $row2['cantidad'];
            $inventario = $row2['inventario'];
            $check_producto = $check_producto + $cantidad_real_producto;
        }
    }

    $check_receta = "SELECT p.nombre,p.cantidad as inventario,i.cantidad as ingrediente,c.cantidad FROM cuentas c INNER JOIN productos p INNER JOIN ingredientes i ON i.id_preparacion = c.id_preparacion AND i.id_producto = p.id WHERE c.id_diario = $id AND c.tipo = 1 AND i.id_producto = $producto;";
    $resultado3 = mysqli_query($con, $check_receta);
    if ($resultado3->num_rows > 0) {
        while ($row3 = mysqli_fetch_assoc($resultado3)) {
            $nombre_real_producto = $row3['nombre'];
            $cantidad_real_producto = $row3['cantidad'];
            $inventario = $row3['inventario'];
            $ingrediente = $row3['ingrediente'];
            $check_producto = $check_producto + ($cantidad_real_producto * $ingrediente);
        }
    }

    if (isset($inventario) && $inventario < $check_producto + $cantidad) {
        echo "No hay suficiente $nombre_real_producto en inventario, solo hay $inventario y ya se agregaron en venta $check_producto";
        exit();
    } else {
        $crearproducto_venta = "INSERT INTO cuentas(tipo,id_preparacion,id_diario,cantidad,valor) VALUES (0,'$producto','$id','$cantidad','$precio');";
        $resultado = mysqli_query($con, $crearproducto_venta);
        if ($resultado) {
            $get_venta = "SELECT valor FROM diario WHERE id = $id;";
            $resultado_get = mysqli_query($con, $get_venta);
            $row = mysqli_fetch_array($resultado_get);
            $valor = $row['valor'];
            $total = $valor + ($precio * $cantidad);
            $update_producto = "UPDATE diario SET valor=$total WHERE id = $id;";
            $resultado_update = mysqli_query($con, $update_producto);
            if ($resultado_update) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }
} else if ($receta != null) {
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["valor"];
    $nombre_producto = 0;
    $cantidad_real = 0;
    $cantidad_pro = 0;

    $getproducto = "SELECT i.cantidad as preparacion,p.cantidad,p.id,p.nombre FROM ingredientes i INNER JOIN productos p ON i.id_producto = p.id WHERE id_preparacion = $receta;";
    $resultado2 = mysqli_query($con, $getproducto);
    if ($resultado2->num_rows > 0) {
        while ($row2 = mysqli_fetch_assoc($resultado2)) {
            $id_producto = $row2['id'];
            $nombre = $row2['nombre'];
            $cantidad_producto = $row2['cantidad'];
            $cantidad_preparacion = $row2['preparacion'];
            $cantidad_usada = $cantidad_preparacion * $cantidad;
            $cantidad_total = $cantidad_producto - $cantidad_usada;
            if ($cantidad_total < 0) {
                $nombre_producto = $nombre;
                $cantidad_real = $cantidad_usada;
                $cantidad_pro = $cantidad_producto;
            }

            $check_prodcuto = "SELECT p.cantidad as inventario,c.cantidad FROM cuentas c INNER JOIN productos p ON c.id_preparacion = p.id WHERE c.id_diario = $id AND c.tipo = 0 AND c.id_preparacion = $id_producto;";
            $resultado2 = mysqli_query($con, $check_prodcuto);
            if ($resultado2->num_rows > 0) {
                while ($row2 = mysqli_fetch_assoc($resultado2)) {
                    $cantidad_real_producto = $row2['cantidad'];
                    $inventario = $row2['inventario'];
                    $check_producto = $check_producto + $cantidad_real_producto;
                }
            }

            $check_receta = "SELECT p.cantidad as inventario,i.cantidad as ingrediente,c.cantidad FROM cuentas c INNER JOIN productos p INNER JOIN ingredientes i ON i.id_preparacion = c.id_preparacion AND i.id_producto = p.id WHERE c.id_diario = $id AND c.tipo = 1 AND i.id_producto = $id_producto;";
            $resultado3 = mysqli_query($con, $check_receta);
            if ($resultado3->num_rows > 0) {
                while ($row3 = mysqli_fetch_assoc($resultado3)) {
                    $cantidad_real_producto = $row3['cantidad'];
                    $inventario = $row3['inventario'];
                    $ingrediente = $row3['ingrediente'];
                    $check_producto = $check_producto + ($cantidad_real_producto * $ingrediente);
                }
            }

            if (isset($inventario) && $inventario < $check_producto + $cantidad) {
                echo "No hay suficiente $nombre en inventario, solo hay $inventario y ya se agregaron en venta $check_producto";
                exit();
            }
        }
    } else {
        echo 0;
    }

    if ($nombre_producto == 0 && $cantidad_real == 0 && $cantidad_pro == 0) {
        $crearreceta_venta = "INSERT INTO cuentas(tipo,id_preparacion,id_diario,cantidad,valor) VALUES (1,'$receta','$id','$cantidad','$precio');";
        $resultado = mysqli_query($con, $crearreceta_venta);
        if ($resultado) {
            $get_venta = "SELECT valor FROM diario WHERE id = $id;";
            $resultado_get = mysqli_query($con, $get_venta);
            $row = mysqli_fetch_array($resultado_get);
            $valor = $row['valor'];
            $total = $valor + ($precio * $cantidad);
            $update_receta = "UPDATE diario SET valor=$total WHERE id = $id;";
            $resultado_update = mysqli_query($con, $update_receta);
            if ($resultado_update) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    } else {
        echo "No hay suficiente $nombre_producto, solo hay $cantidad_pro y se necesitan $cantidad_real.";
    }
}
