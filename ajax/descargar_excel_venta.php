<?php require_once '../conexion.php';
$con = conectar();
$id = $_GET['id'];
header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
header('Content-Disposition: attachment; filename=venta_' . $id . '.xls'); ?>
<table border="1">
    <thead>
        <tr>
            <th colspan="4">VENTAS</th>
        </tr>
        <tr>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Cantidad usada</th>
            <th>Cantidad actual</th>
            <th>Cantidad real</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php $historial_ven = "SELECT d.fecha,c.* FROM cuentas c INNER JOIN diario d ON d.id = c.id_diario WHERE c.id_preparacion = $id AND tipo = 0 ORDER BY d.fecha DESC;";
        $resultado = mysqli_query($con, $historial_ven);
        if ($resultado->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $dia = date("d", strtotime($row["fecha"]));
                $mes = date("m", strtotime($row["fecha"]));
                $ano = date("Y", strtotime($row["fecha"])); ?>
                <tr>
                    <td><?php echo $dia; ?></td>
                    <td><?php echo $mes; ?></td>
                    <td><?php echo $ano; ?></td>
                    <td><?php echo number_format($row["cantidad"], 2) . ' ' . $und; ?></td>
                    <td><b>Venta Producto</b></td>
                </tr>
            <?php }
        }

        $historial_ven = "SELECT d.fecha,c.*,i.id_producto,i.cantidad as receta FROM cuentas c INNER JOIN diario d ON d.id = c.id_diario INNER JOIN ingredientes i ON c.id_preparacion = i.id_preparacion WHERE i.id_producto = $id AND c.tipo = 1 ORDER BY d.fecha DESC;";
        $resultado = mysqli_query($con, $historial_ven);
        if ($resultado->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $dia = date("d", strtotime($row["fecha"]));
                $mes = date("m", strtotime($row["fecha"]));
                $ano = date("Y", strtotime($row["fecha"])); ?>
                <tr>
                    <td><?php echo $dia; ?></td>
                    <td><?php echo $mes; ?></td>
                    <td><?php echo $ano; ?></td>
                    <td><?php echo number_format(($row["cantidad"] * $row["receta"]), 2) . ' ' . $und; ?></td>
                    <td><b>Venta Receta</b></td>
                </tr>
        <?php }
        } ?>
    </tbody>
</table>