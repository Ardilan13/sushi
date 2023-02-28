<?php
ini_set('date.timezone', 'America/Bogota');
function conectar()
{
    $usuario = "root";
    $contra = "HaikoSushi";
    $ip = "localhost";
    $bd = "sushi";
    $port = "3306";

    $conexion = new mysqli($ip, $usuario, $contra, $bd, $port);

    if ($conexion->connect_errno) {
        return "Error en la conexion.";
    } else {
        return $conexion;
    }
}
