<?php
require_once '../conexion.php';
$con = conectar();

$id = $_POST['id'];

$sql = "DELETE FROM preparaciones WHERE id = $id";
if ($con->query($sql) === TRUE) {
    echo 1;
    $sql = "DELETE FROM ingredientes WHERE id_preparacion = $id";
    if ($con->query($sql) === TRUE) {
    } else {
        echo 0;
    }
} else {
    echo 0;
};

$con->close();
