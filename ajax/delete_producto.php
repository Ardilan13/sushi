<?php
require_once '../conexion.php';
$con = conectar();

$id = $_POST['id'];

$sql = "DELETE FROM productos WHERE id = $id";
if ($con->query($sql) === TRUE) {
    echo 1;
} else {
    echo 0;
};

$con->close();
