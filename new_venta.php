<?php require_once 'includes/header.php';
require_once 'includes/auth.php';
require_once 'conexion.php';
$con = conectar(); ?>
<main>
    <div class="container">
        <div class="header">
            <?php
            if (isset($_GET["id"])) {
                $id = $_GET["id"]; ?>
                <p>Editar Venta</p>
            <?php } else { ?>
                <p>Nueva Venta</p>
            <?php } ?>
        </div>
        <div class="info">
            <form id="new_venta">
                <?php if (isset($_GET["id"])) {
                    $get_diario = "SELECT * from diario WHERE id = $id;";
                    $resultado = mysqli_query($con, $get_diario);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) { ?>
                            <input hidden type="text" id="id" name="id" value="<?php echo $id; ?>" required>
                            <div class="input">
                                <label for="fecha">Fecha:</label>
                                <input disabled type="text" id="fecha_null" value="<?php echo $row['fecha']; ?>" name="fecha_null" required>
                            </div>
                            <table id="tabla" class="display" style="width:80%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Valor</th>
                                        <?php if ($_SESSION["id"] == 'admin' && $row['status'] != 1) { ?>
                                            <th>Borrar</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
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
                                                        <?php if ($_SESSION["id"] == 'admin' && $row['status'] != 1) { ?>
                                                            <td class="min">
                                                                <button class="edit delete delete_venta_pro" id="<?php echo $row2["id"]; ?>" name="<?php echo $row2["nombre"]; ?>">
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
                                            } ?>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                            <button hidden id="clonar">clon</button>
                            <div class="input">
                                <label for="valor">Valor:</label>
                                <input disabled value="<?php echo number_format($row['valor'], 3); ?>" type="text" id="valor_venta" name="valor_venta" required>
                            </div>

                            <?php if ($row['status'] != 1) { ?>
                                <button type="submit" class="edit" value="<?php echo $id; ?>" id="agg_producto1">Agregar Producto</button>
                                <button type="submit" value="<?php echo $id; ?>" id="agg_receta1">Agregar Receta</button>
                                <button type="submit" value="<?php echo $id; ?>" id="agg_venta">Guardar</button>
                            <?php } else { ?>
                                <button type="submit" value="<?php echo $id; ?>" id="export_venta">Exportar</button>
                            <?php } ?>

                    <?php }
                    } ?>
                <?php } else { ?>
                    <div class="input">
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" required>
                    </div>
                    <div class="input" style="margin-right: 0; justify-content:center;">
                        <label>No hay ningun producto o receta asignado.</label>
                    </div>
                    <button type="submit" class="edit" id="agg_producto">Agregar Producto</button>
                    <button type="submit" id="agg_receta">Agregar Receta</button>

                <?php } ?>
            </form>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>