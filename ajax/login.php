<?php
$clave = $_POST["clave"];

if ($clave == 'prueba') {
    session_start();
    $_SESSION["id"] = $clave;
    echo 1;
} else {
    echo 0;
}
