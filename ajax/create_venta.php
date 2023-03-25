<?php require_once '../conexion.php';
$con = conectar();

$id = isset($_POST["id"]) ? $_POST["id"] : null;
$producto = isset($_POST["producto"]) ? $_POST["producto"] : null;
$receta = isset($_POST["receta"]) ? $_POST["receta"] : null;

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
} else if ($receta != null) {
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["valor"];

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
}
