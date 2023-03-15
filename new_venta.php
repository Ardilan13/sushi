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
                    $get_preparacion = "SELECT * from diario WHERE id = $id;";
                    $resultado = mysqli_query($con, $get_preparacion);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) { ?>
                            <input hidden type="text" id="id" name="id" value="<?php echo $id; ?>" required>
                            <div class="input">
                                <label for="fecha">Fecha:</label>
                                <input disabled type="text" id="fecha" value="<?php echo $row['fecha']; ?>" name="fecha" required>
                            </div>
                            <div class="input">
                                <label for="tipo">Tipo:</label>
                                <select disabled name="tipo" id="tipo" required>
                                    <option></option>
                                    <option <?php if ($row['tipo'] == 1) echo 'selected'; ?> value="1">Preparacion</option>
                                    <option <?php if ($row['tipo'] == 2) echo 'selected'; ?> value="2">Receta</option>
                                </select>
                            </div>
                            <table id="tabla" class="display" style="width:80%">
                                <thead>
                                    <tr>
                                        <?php if ($row["tipo"] == 2) { ?>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                        <?php } else { ?>
                                            <th>Producto</th>
                                        <?php } ?>
                                        <th>Cantidad</th>
                                        <th>Valor</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $get_preparacion = "SELECT (SELECT nombre FROM productos WHERE id = id_producto) as producto,cantidad, valor, id,tipo, (SELECT unidad FROM productos WHERE id = id_producto) as unidad from ingredientes WHERE id_preparacion = $id;";
                                    $resultado = mysqli_query($con, $get_preparacion);
                                    if ($resultado->num_rows > 0) {
                                        while ($row1 = mysqli_fetch_assoc($resultado)) {
                                            if ($row1["unidad"] == 1) {
                                                $und = 'Kgs';
                                            } else if ($row1["unidad"] == 2) {
                                                $und = 'Lts';
                                            } else  if ($row1["unidad"] == 3) {
                                                $und = 'Und';
                                            } else {
                                                $und = null;
                                            }

                                            if ($row1["tipo"] == 0) {
                                                $tipo = 'Producto';
                                            } else {
                                                $tipo = 'Preparacion';
                                            } ?>
                                            <tr>
                                                <td><?php echo $row1['producto']; ?></td>
                                                <?php if ($row["tipo"] == 2) { ?>
                                                    <td><?php echo $tipo; ?></td>
                                                <?php } ?>
                                                <td class="mid"><?php echo $row1['cantidad'] . " " . $und ?></td>
                                                <td id="valor_ing"><?php echo $row1['valor']; ?></td>
                                                <td class="mid">
                                                    <?php if ($row1["tipo"] == 0) { ?>
                                                        <button class="edit edit_pre_pro" id="<?php echo $row1["id"]; ?>">
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

                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                            <button hidden id="clonar">clon</button>
                            <div class="input">
                                <label for="cantidad">Cantidad:</label>
                                <input value="<?php echo $row['cantidad']; ?>" type="text" min="0" id="cantidad" name="cantidad" required>
                            </div>
                            <div class="input">
                                <label for="unidad">Unidad:</label>
                                <select name="unidad" id="unidad" required>
                                    <option></option>
                                    <option <?php if ($row["unidad"] == 1) { ?> selected <?php }; ?> value="1">Kilogramos</option>
                                    <option <?php if ($row["unidad"] == 2) { ?> selected <?php }; ?> value="2">Litros</option>
                                    <option <?php if ($row["unidad"] == 3) { ?> selected <?php }; ?> value="3">Unidades</option>
                                </select>
                            </div>
                            <div class="input">
                                <label for="valor">Costo:</label>
                                <input disabled value="<?php echo $row['valor']; ?>" type="text" id="nombre" name="nombre" required>
                            </div>

                            <button type="submit" class="edit" id="agg_producto">Agregar Producto</button>
                            <button type="submit" id="agg_receta">Agregar Receta</button>
                            <button type="submit" id="agg_venta">Guardar Venta</button>
                    <?php }
                    } ?>
                <?php } else { ?>
                    <div class="input">
                        <label for="fecha">Fecha:</label>
                        <input disabled type="text" id="fecha" value="<?php echo date("d-m-Y"); ?>" name="fecha" required>
                    </div>
                    <div class="input" style="margin-right: 0; justify-content:center;">
                        <label>No hay ningun producto o receta asignado.</label>
                    </div>
                    <div class="input">
                        <label for="valor">Valor:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    //Crear la venta en diario al presionar cualquiera de los tres botones, para luego ejecutar su debida respuesta
                    //Al crearse la venta, recargar la pagina con un get id, para mostrar o agregar productos y recetas
                    //
                    <button type="submit" class="edit" id="agg_producto">Agregar Producto</button>
                    <button type="submit" id="agg_receta">Agregar Receta</button>

                <?php } ?>
            </form>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>