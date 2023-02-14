<?php
function conectar()
{
    $usuario = "ardilan";
    $contra = "transformice13";
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
