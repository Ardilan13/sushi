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
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Fecha</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <?php if ($_SESSION["id"] == 'admin') { ?>
                            <th>Borrar</th>
                        <?php } ?>
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
                                <td><?php echo $row["id"]; ?></td>
                                <td><?php echo $row["producto"]; ?></td>
                                <td class="precio"><?php echo $row["fecha"]; ?></td>
                                <td class="status_<?php echo $row['status']; ?>"><?php echo number_format($row["precio"], 2); ?></td>
                                <td class="mid"><?php echo number_format($row["cantidad"], 2) . ' ' . $und; ?></td>
                                <td><?php echo number_format(($row["precio"] * $row["cantidad"]), 2) ?></td>
                                <?php if ($_SESSION["id"] == 'admin') { ?>
                                    <td class="min">
                                        <button class="delete delete_com" id="<?php echo $row["id"]; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <line x1="4" y1="7" x2="20" y2="7" />
                                                <line x1="10" y1="11" x2="10" y2="17" />
                                                <line x1="14" y1="11" x2="14" y2="17" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </td>
                                <?php } ?>
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