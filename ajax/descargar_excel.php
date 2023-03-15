<?php require_once '../conexion.php';
$con = conectar();
header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
header('Content-Disposition: attachment; filename=inventario_' . date("d-M-Y") . '.xls'); ?>
<table border="1">
    <thead>
        <th colspan="5">PRODUCTOS</th>
    </thead>
    <tr>
        <td>Nombre</td>
        <td>Merma</td>
        <td>Precio de Compra</td>
        <td>Cantidad</td>
        <td>Precio Real</td>
    </tr>
    <?php
    $login = "SELECT nombre from productos;";
    $resultado = mysqli_query($con, $login);
    while ($row = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo $row["nombre"]; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php } ?>
</table>

<table border="1">
    <thead>
        <th colspan="4">PREPARACIONES</th>
    </thead>
    <tr>
        <td>Nombre</td>
        <td>Tipo</td>
        <td>Cantidad</td>
        <td>Valor</td>
    </tr>
    <?php
    $login = "SELECT nombre from preparaciones WHERE tipo = 1;";
    $resultado = mysqli_query($con, $login);
    while ($row = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo $row["nombre"]; ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php } ?>
</table>

<table border="1">
    <thead>
        <th colspan="4">RECETAS</th>
    </thead>
    <tr>
        <td>Nombre</td>
        <td>Tipo</td>
        <td>Cantidad</td>
        <td>Valor</td>
    </tr>
    <?php
    $login = "SELECT nombre from preparaciones WHERE tipo = 2;";
    $resultado = mysqli_query($con, $login);
    while ($row = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo $row["nombre"]; ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php } ?>
</table>