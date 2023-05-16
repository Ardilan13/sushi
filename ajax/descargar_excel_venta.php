<?php require_once '../conexion.php';
$con = conectar();
$id = $_GET['id'];
header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
header('Content-Disposition: attachment; filename=venta_' . $id . '.xls'); ?>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $get_diario = "SELECT * from diario WHERE id = $id;";
        $resultado = mysqli_query($con, $get_diario);
        if ($resultado->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $get_cuentas = "SELECT id,tipo FROM cuentas WHERE id_diario = $id;";
                $resultado1 = mysqli_query($con, $get_cuentas);
                if ($resultado1->num_rows > 0) {
                    while ($row1 = mysqli_fetch_assoc($resultado1)) {
                        if ($row1['tipo'] == 0) {
                            $tipo = 'Producto';
                            $cuentas_diario = "SELECT *,(SELECT nombre FROM productos WHERE id = id_preparacion) as nombre,(SELECT unidad FROM productos WHERE id = id_preparacion) as unidad FROM cuentas WHERE id_diario = $id AND id = {$row1['id']};";
                        } else if ($row1['tipo'] == 1) {
                            $tipo = 'Receta';
                            $cuentas_diario = "SELECT *,(SELECT nombre FROM preparaciones WHERE id = id_preparacion) as nombre,(SELECT unidad FROM preparaciones WHERE id = id_preparacion) as unidad FROM cuentas WHERE id_diario = $id AND id = {$row1['id']};";
                        }
                        $resultado2 = mysqli_query($con, $cuentas_diario);
                        if ($resultado2->num_rows > 0) {
                            while ($row2 = mysqli_fetch_assoc($resultado2)) {
                                if ($row2["unidad"] == 1) {
                                    $und = 'Kgs';
                                } else if ($row2["unidad"] == 2) {
                                    $und = 'Lts';
                                } else  if ($row2["unidad"] == 3) {
                                    $und = 'Und';
                                } else {
                                    $und = null;
                                } ?>
                                <tr>
                                    <td><?php echo $row2['nombre']; ?></td>
                                    <td><?php echo $tipo; ?></td>
                                    <td><?php echo number_format($row2['valor'], 3); ?></td>
                                    <td class="mid"><?php echo number_format($row2['cantidad'], 3) . " " . $und ?></td>
                                    <td><?php echo number_format($row2['valor'] * $row2['cantidad'], 3); ?></td>
                                </tr>
                        <?php }
                        } ?>
                <?php }
                } ?>
                <tr></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Valor:</td>
                    <td><?php echo number_format($row['valor'], 3); ?></td>
                </tr>
    </tbody>
</table>
<?php }
        } ?>