<?php require_once '../conexion.php';
$con = conectar();

$producto = $_POST["producto"];
$fecha = date_create($_POST["fecha"]);
$fecha = date_format($fecha, "Y-m-d");
$cantidad = $_POST["cantidad"];
$precio = $_POST["valor"];
$status = null;

$crear_compra = "INSERT INTO compra(id_producto, fecha, cantidad, precio) VALUES ($producto,'$fecha',$cantidad,$precio);";
$resultado = mysqli_query($con, $crear_compra);
if ($resultado) {
    $get_producto = "SELECT cantidad, precio, merma FROM productos WHERE id = $producto LIMIT 1;";
    $resultado_get = mysqli_query($con, $get_producto);
    $row = mysqli_fetch_array($resultado_get);
    $total = (float)$row['cantidad'] + ((float)$cantidad - (((float)$cantidad * (float)$row['merma']) / 100));
    $precioU = (((float)$row['precio'] * (float)$row['cantidad']) + ((float)$precio * (float)$cantidad)) / $total;
    if ($row['precio'] > $precioU) {
        $status = 0;
    } else if ($row['precio'] < $precioU) {
        $status = 1;
    } else {
        $status = 2;
    }
    $update_producto = "UPDATE productos SET status = $status, cantidad=$total, precio=$precioU WHERE id = $producto;";
    $resultado_update = mysqli_query($con, $update_producto);
    if ($resultado_update) {
        $update_receta = "UPDATE ingredientes SET valor=$precioU WHERE id_producto = $producto;";
        $res_update = mysqli_query($con, $update_receta);
        if ($res_update) {
            $get_recetas = "SELECT p.id FROM preparaciones p INNER JOIN ingredientes i ON p.id = i.id_preparacion WHERE i.id_producto = $producto;";
            $resultado_get_r = mysqli_query($con, $get_recetas);
            while ($row1 = mysqli_fetch_assoc($resultado_get_r)) {
                $valor = 0;
                $get_recetas_p = "SELECT cantidad,valor FROM ingredientes WHERE id_preparacion = " . $row1['id'] . ";";
                $resultado_get_rp = mysqli_query($con, $get_recetas_p);
                while ($row2 = mysqli_fetch_assoc($resultado_get_rp)) {
                    $valor += $row2['cantidad'] * $row2['valor'];
                }
                if ($valor != 0) {
                    $update_valor = "UPDATE preparaciones SET valor=$valor WHERE id = " . $row1['id'] . ";";
                    $res_update_valor = mysqli_query($con, $update_valor);
                }
            }
            echo 1;
        } else {
            echo $res_update;
        }
    } else {
        echo $update_producto;
    }
} else {
    echo 0;
}
