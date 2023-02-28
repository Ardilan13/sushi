<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION["id"] != 'prueba' && $_SESSION["id"] != 'admin') {
    header('Location: index.php');
}
