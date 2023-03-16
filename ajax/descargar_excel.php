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
        <td>Cantidad Real</td>
        <td>Precio Real</td>
    </tr>
    <?php
    $login = "SELECT * from productos ORDER BY nombre ASC;";
    $resultado = mysqli_query($con, $login);
    while ($row = mysqli_fetch_assoc($resultado)) {
        (float)$merma = $row["merma"] / 100;
        (float)$total = ($row["cantidad"] * $row["precio"]) + ($row["cantidad"] * $row["precio"]) * $merma; ?>
        <tr>
            <td><?php echo $row["nombre"]; ?></td>
            <td><?php echo $row["merma"] . '%'; ?></td>
            <td><?php echo $row["precio"]; ?></td>
            <td><?php echo $row["cantidad"]; ?></td>
            <td></td>
            <td><?php echo number_format($total, 2); ?></td>
        </tr>
    <?php } ?>
</table>

<table border="1">
    <thead>
        <th colspan="4">PREPARACIONES</th>
    </thead>
    <tr>
        <td>Nombre</td>
        <td>Cantidad</td>
        <td>Cantidad Real</td>
        <td>Valor</td>
    </tr>
    <?php
    $login = "SELECT * from preparaciones WHERE tipo = 1 ORDER BY nombre ASC;";
    $resultado = mysqli_query($con, $login);
    while ($row = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo $row["nombre"]; ?></td>
            <td><?php echo $row["cantidad"]; ?></td>
            <td></td>
            <td><?php echo $row["valor"]; ?></td>
        </tr>
    <?php } ?>
</table>

<table border="1">
    <thead>
        <th colspan="4">RECETAS</th>
    </thead>
    <tr>
        <td>Nombre</td>
        <td>Cantidad</td>
        <td>Cantidad Real</td>
        <td>Valor</td>
    </tr>
    <?php
    $login = "SELECT * from preparaciones WHERE tipo = 2 ORDER BY nombre ASC;";
    $resultado = mysqli_query($con, $login);
    while ($row = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo $row["nombre"]; ?></td>
            <td><?php echo $row["cantidad"]; ?></td>
            <td></td>
            <td><?php echo $row["valor"]; ?></td>
        </tr>
    <?php } ?>
</table>