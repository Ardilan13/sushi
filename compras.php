<?php require_once 'includes/header.php';
require_once 'includes/auth.php';
require_once 'conexion.php';
$con = conectar(); ?>

<main>
    <div class="container">
        <div class="header">
            <p>Compras</p>
        </div>
        <div class="info">
            <table id="tabla" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Fecha</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_compras = "SELECT c.id,p.nombre as producto,p.unidad,p.status,c.fecha, c.cantidad, c.precio FROM compra c join productos p on c.id_producto = p.id ORDER BY id DESC;";
                    $resultado = mysqli_query($con, $get_compras);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) { ?>
                            <?php if ($row["unidad"] == 1) {
                                $und = 'Kgs';
                            } else if ($row["unidad"] == 2) {
                                $und = 'Lts';
                            } else {
                                $und = 'Und';
                            } ?>
                            <tr>
                                <td><?php echo $row["producto"]; ?></td>
                                <td class="precio"><?php echo $row["fecha"]; ?></td>
                                <td class="status_<?php echo $row['status']; ?>"><?php echo number_format($row["precio"], 2); ?></td>
                                <td class="mid"><?php echo number_format($row["cantidad"], 1) . ' ' . $und; ?></td>
                                <td><?php echo number_format(($row["precio"] * $row["cantidad"]), 2) ?></td>
                            </tr>
                    <?php }
                    } else {
                        echo "<td valign='top' colspan='8' class='dataTables_empty'>No hay compras para mostrar</td>";
                    } ?>
                </tbody>
            </table>
            <button hidden id="clonar">clon</button>
            <div class="botones">
                <button id="new_com">Nueva Compra</button>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>