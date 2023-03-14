<?php require_once '../conexion.php';
$con = conectar();
header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
header('Content-Disposition: attachment; filename=hola.xls'); ?>
<table>
    <?php
    $login = "SELECT p.*,r* from productos p INNER JOIN preparaciones r;";
    $resultado = mysqli_query($con, $login);
    while ($row = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo $row["p.nombre"]; ?></td>
            <td><?php echo $row["r.nombre"]; ?></td>
        </tr>
    <?php } ?>
</table>