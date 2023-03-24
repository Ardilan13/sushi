<?php require_once 'includes/header.php';
require_once 'includes/auth.php';
require_once 'conexion.php';
$con = conectar(); ?>
<main>
    <div class="container">
        <div class="header">
            <p>Productos</p>
        </div>
        <div class="info">
            <table id="tabla" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Proveedor</th>
                        <th>Merma</th>
                        <th>Precio de Compra</th>
                        <th>Precio Real</th>
                        <th>Cantidad</th>
                        <th>Precio Total</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $suma = 0;
                    $login = "SELECT * from productos ORDER BY id DESC;";
                    $resultado = mysqli_query($con, $login);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            (float)$merma = $row["merma"] / 100;
                            (float)$total = ($row["cantidad"] * $row["precio"]) + ($row["cantidad"] * $row["precio"]) * $merma;
                            $suma = $suma + $total;  ?>
                            <!-- <td class="mid"> -->
                            <?php if ($row["unidad"] == 1) {
                                $und = 'Kgs';
                            } else if ($row["unidad"] == 2) {
                                $und = 'Lts';
                            } else {
                                $und = 'Und';
                            } ?>
                            <!-- </td> -->
                            <tr>
                                <td><?php echo $row["nombre"]; ?></td>
                                <td class="mid">
                                    <?php $tipo = "SELECT * from tipo where id = {$row["tipo"]} LIMIT 1;";
                                    $resultado2 = mysqli_query($con, $tipo);
                                    if ($resultado2->num_rows > 0) {
                                        while ($row2 = mysqli_fetch_assoc($resultado2)) {
                                            echo $row2["nombre"];
                                        }
                                    } ?>
                                </td>
                                <td><?php echo $row["proveedor"]; ?></td>
                                <td class="min"><?php echo $row["merma"]; ?></td>
                                <td class="precio status_<?php echo $row['status']; ?>"><?php echo number_format($row["precio"], 2); ?></td>
                                <td class="precio status_<?php echo $row['status']; ?>"><?php echo number_format(($row["precio"] + $row["precio"] * $merma), 2); ?></td>
                                <td class="mid"><?php echo number_format($row["cantidad"], 2) . ' ' . $und; ?></td>
                                <td class="precio"><?php echo number_format($total, 2); ?></td>
                                <td class="min">
                                    <button class="edit edit_pro" id="<?php echo $row["id"]; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                            <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                    <?php }
                    } else {
                        echo "<td valign='top' colspan='8' class='dataTables_empty'>No hay productos para mostrar</td>";
                    } ?>
                </tbody>
            </table>
            <button hidden id="clonar">clon</button>
            <form>
                <div class="input">
                    <label for="inventario">Valor inventario:</label>
                    <input disabled type="text" value="<?php echo number_format($suma, 2); ?>">
                </div>
            </form>

            <div class="botones">
                <?php if ($_SESSION["id"] == 'admin') { ?>
                    <button class="edit des_exc">Descargar Excel</button>
                <?php } ?>
                <button id="new_pro">Nuevo Producto</button>
            </div>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>