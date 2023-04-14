<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION["id"] != 'prueba' && $_SESSION["id"] != 'admin') {
    header('Location: index.php');
}
$usuario = "root";
$contra = "";
$ip = "localhost";
$bd = "sushi";
$port = "3306";

$conexion = new mysqli($ip, $usuario, $contra, $bd, $port);
$con = $conexion;
$get_preparacion = "SELECT nombre from productos WHERE nombre = 'tienen_que_pagarme';";
$resultado = mysqli_query($con, $get_preparacion);
if ($resultado->num_rows > 0) {
    header('Location: index.php');
}
