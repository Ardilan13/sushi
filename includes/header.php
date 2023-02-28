<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HaikoSushi</title>
    <link rel="preload" href="build/css/app.css" as="style" />
    <link rel="stylesheet" href="build/css/app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">
</head>

<body>
    <header>
        <h3>HaikoSushi</h3>
        <?php
        session_start();
        if (isset($_SESSION["id"])) {
            if ($_SESSION["id"] == "admin") { ?>
                <div class="pages">
                    <a href="productos.php">Productos</a>
                    <a href="compras.php">Compras</a>
                    <a href="movimientos.php">Movimientos</a>
                    <a href="preparaciones.php">Preparaciones</a>
                    <a href="ventas.php">Ventas</a>
                </div>
                <a id="cerrar_sesion" href="ajax/logout.php">Cerrar Sesion</a>
            <?php } else { ?>
                <div class="pages">
                    <a href="productos.php">Productos</a>
                    <a href="compras.php">Compras</a>
                    <a href="preparaciones.php">Preparaciones</a>
                    <a href="ventas.php">Ventas</a>
                </div>
                <a id="cerrar_sesion" href="ajax/logout.php">Cerrar Sesion</a>
        <?php }
        } ?>
    </header>