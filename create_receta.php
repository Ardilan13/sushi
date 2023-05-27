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
                <p>Agregar Receta Venta</p>
            <?php } ?>
        </div>
        <div class="info">
            <form id="new_producto_venta">
                <?php if (isset($_GET["id"])) {
                    $get_preparacion = "SELECT * from diario WHERE id = $id;";
                    $resultado = mysqli_query($con, $get_preparacion);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) { ?>
                            <input hidden type="text" id="id" name="id" value="<?php echo $id; ?>" required>
                            <div class="input">
                                <label for="producto">Receta:</label>
                                <select type="text" id="receta" name="receta" min="0" required>
                                    <option></option>
                                    <?php $get_preparacion = "SELECT * from preparaciones WHERE tipo = 2 ORDER BY nombre ASC;";
                                    $resultado1 = mysqli_query($con, $get_preparacion);
                                    if ($resultado1->num_rows > 0) {
                                        while ($row1 = mysqli_fetch_assoc($resultado1)) { ?>
                                            <option valor="<?php echo $row1['valor'] ?>" value="<?php echo $row1['id'] ?>"><?php echo $row1['nombre'] ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="input">
                                <label for="cantidad" id="unidad_producto">Cantidad:</label>
                                <input type="number" id="cantidad" name="cantidad" min="0" required>
                            </div>
                            <div class="input">
                                <label for="precio">Precio:</label>
                                <input type="number" id="valor_receta" name="valor" min="0" required>
                            </div>

                            <button type="submit" value="<?php echo $id; ?>" id="agg_receta_venta">Guardar</button>
                    <?php }
                    } ?>
                <?php } ?>
            </form>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>