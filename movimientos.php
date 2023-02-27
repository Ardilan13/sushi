<?php require_once 'includes/header.php';
require_once 'includes/auth.php';
require_once 'conexion.php';
$con = conectar(); ?>
<main>
    <div class="container">
        <div class="header">
            <p>Movimientos</p>
        </div>
        <div class="info">
            <table id="tabla" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th class="mid">Tipo</th>
                        <th class="mid">Fecha</th>
                        <th class="mid">Cantidad</th>
                        <th>Motivo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $login = "SELECT p.nombre as producto,p.unidad,m.tipo,m.fecha, m.cantidad, m.motivo FROM movimientos m join productos p on m.id_producto = p.id ORDER BY m.id DESC;";
                    $resultado = mysqli_query($con, $login);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            if ($row["unidad"] == 1) {
                                $und = 'Kgs';
                            } else if ($row["unidad"] == 2) {
                                $und = 'Lts';
                            } else {
                                $und = 'Und';
                            } ?>
                            <tr>
                                <td><?php echo $row["producto"]; ?></td>
                                <td class="status_<?php echo $row['tipo']; ?>">
                                    <?php if ($row["tipo"] == 1) {
                                        echo 'Salida';
                                    } else if ($row["tipo"] == 0) {
                                        echo 'Entrada';
                                    } ?>
                                </td>
                                <td><?php echo $row["fecha"]; ?></td>
                                <td><?php echo number_format($row["cantidad"], 1) . ' ' . $und; ?></td>
                                <td><?php echo $row["motivo"]; ?></td>
                            </tr>
                    <?php }
                    } else {
                        echo "<td valign='top' colspan='8' class='dataTables_empty'>No hay productos para mostrar</td>";
                    } ?>
                </tbody>
            </table>
            <button hidden id="clonar">clon</button>

            <div class="botones">
                <button class="new_mov">Generar Movimiento</button>
            </div>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>