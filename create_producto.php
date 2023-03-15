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
                <p>Agregar Producto Venta</p>
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
                                <label for="producto">Producto:</label>
                                <select type="text" id="producto" name="producto" min="0" required></select>
                            </div>
                            <div class="input">
                                <label for="cantidad" id="unidad_producto">Cantidad:</label>
                                <input type="number" id="cantidad" name="cantidad" min="0" required>
                            </div>
                            <div class="input">
                                <label for="precio">Precio:</label>
                                <input type="number" id="precio" name="precio" min="0" required>
                            </div>

                            <button type="submit" id="agg_producto_venta">Guardar</button>
                    <?php }
                    } ?>
                <?php } ?>
            </form>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>