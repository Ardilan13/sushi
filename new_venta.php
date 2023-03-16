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
                                        <th>Cantidad</th>
                                        <th>Valor</th>
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
                                                $cuentas_diario = "SELECT *,(SELECT nombre FROM preparaciones WHERE id = id_preparacion) as nombre,(SELECT unidad FROM productos WHERE id = id_preparacion) as unidad FROM cuentas WHERE id_diario = $id AND id = {$row1['id']};";
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
                                                        <td class="mid"><?php echo $row2['cantidad'] . " " . $und ?></td>
                                                        <td id="valor_ing"><?php echo $row2['valor']; ?></td>
                                                        <!-- <td class="mid">
                                                            <?php if ($row2["tipo"] == 0) { ?>
                                                                <button class="edit edit_pre_pro" id="<?php echo $row2["id"]; ?>">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                                                        <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                                                    </svg>
                                                                </button>
                                                            <?php } else { ?>
                                                                <button class="edit edit_pre" id="<?php echo $row["id"]; ?>">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                                                        <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                                                    </svg>
                                                                </button>
                                                            <?php } ?>

                                                        </td> -->
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
                                <input disabled value="<?php echo $row['valor']; ?>" type="text" id="nombre" name="nombre" required>
                            </div>

                            <button type="submit" class="edit" value="<?php echo $id; ?>" id="agg_producto1">Agregar Producto</button>
                            <button type="submit" value="<?php echo $id; ?>" id="agg_receta1">Agregar Receta</button>
                            <button type="submit" id="agg_venta">Guardar</button>
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