<?php require_once 'includes/header.php';
require_once 'includes/auth.php';
$id = $_GET['id'] ?? null; ?>
<main>
    <div class="container">
        <div class="header">
            <p>Generar Produccion</p>
        </div>
        <div class="info">
            <?php require_once 'conexion.php';
            $con = conectar();
            $get_producto = "SELECT * FROM productos WHERE id = $id;";
            $resultado = mysqli_query($con, $get_producto);
            if ($resultado->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                    if ($row["unidad"] == 1) {
                        $und = 'Kgs';
                    } else if ($row["unidad"] == 2) {
                        $und = 'Lts';
                    } else {
                        $und = 'Und';
                    } ?>
                    <div class="input">
                        <label for="pro">Producto:</label>
                        <input disabled value="<?php echo $row['nombre']; ?>" type="text" id="pro" name="pro" required>
                    </div>
                    <div class="input">
                        <label for="cantidad_pro" id="unidad_pro">Cantidad:</label>
                        <input type="text" disabled value="<?php echo $row['cantidad'] . ' ' . $und; ?>" id="cantidad_pro" name="cantidad_pro" min="0" required>
                    </div>
                    <div class="radio">
                        <label for="nuevo">Nuevo</label>
                        <input type="radio" id="nuevo" name="producido" value="nuevo">
                        <label for="existente">Existente</label>
                        <input type="radio" id="existente" name="producido" value="existente">
                    </div>

                    <div class="existente">
                        <form id="update_producto_pro">
                            <input type="text" hidden value="<?php echo $id; ?>" name="id">
                            <input type="text" hidden value="<?php echo $row['cantidad']; ?>" id="test1" name="total1">
                            <div class="input">
                                <label for="cantidad_pro_2" id="unidad_producto">Cantidad a usar:</label>
                                <input type="number" id="cantidad_pro_2" name="cantidad_pro_2" min="0" required>
                            </div>
                            <div class="input">
                                <label for="producto">Producto:</label>
                                <select name="producto" id="producto" required>
                                    <!-- Generado por ajax list_product -->
                                </select>
                            </div>
                            <div class="input">
                                <label for="cantidad_new" id="unidad_producto">Cantidad:</label>
                                <input type="number" id="cantidad_new" name="cantidad_new" min="0" required>
                            </div>
                            <button type="submit" id="update_produccion">Actualizar producto</button>
                        </form>
                    </div>

                    <div class="nuevo">
                        <form id="new_producto_pro">
                            <input type="text" hidden value="<?php echo $row['cantidad']; ?>" id="test" name="total">
                            <input type="text" hidden value="<?php echo $id; ?>" name="id">

                            <div class="input">
                                <label for="nombre">Cantidad a usar:</label>
                                <input type="number" name="cantidad_pro_1" id="cantidad_pro_1" min="0" required>
                            </div>
                            <div class="input">
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" required>
                            </div>
                            <div class="input">
                                <label for="tipo">Tipo:</label>
                                <select name="tipo" id="tipo" required>
                                    <option></option>
                                    <?php $tipo = "SELECT * from tipo";
                                    $resultado2 = mysqli_query($con, $tipo);
                                    if ($resultado2->num_rows > 0) {
                                        while ($row2 = mysqli_fetch_assoc($resultado2)) { ?>
                                            <option value="<?php echo $row2['id'] ?>"><?php echo $row2['nombre'] ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="input">
                                <label for="unidad">Unidad:</label>
                                <select name="unidad" id="unidad" required>
                                    <option></option>
                                    <option value="1">Kilogramos</option>
                                    <option value="2">Litros</option>
                                    <option value="3">Unidades</option>
                                </select>
                            </div>
                            <div class="input">
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" id="cantidad" name="cantidad" min="0" required>
                            </div>
                            <button type="submit" id="add_producto_pro">Crear Producto</button>
                        </form>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>