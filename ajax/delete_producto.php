<?php
require_once '../conexion.php';
$con = conectar();

$id = $_POST['id'];

$sql = "DELETE FROM productos WHERE id = $id";
if ($con->query($sql) === TRUE) {
    $ing = "DELETE FROM ingredientes WHERE id_producto = $id";
    if ($con->query($ing) === TRUE) {
        $com = "DELETE FROM compra WHERE id_producto = $id";
        if ($con->query($com) === TRUE) {
            $mov = "DELETE FROM movimientos WHERE id_producto = $id";
            if ($con->query($mov) === TRUE) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
};

$con->close();
