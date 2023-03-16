<?php require_once 'includes/header.php';
require_once 'includes/auth.php'; ?>
<main>
    <div class="container">
        <div class="header">
            <?php if (isset($_GET["id"])) { ?>
                <p>Editar Compra</p>
            <?php } else { ?>
                <p>Nueva Compra</p>
            <?php } ?>
        </div>
        <div class="info">
            <form id="new_compra">
                <?php if (isset($_GET["id"])) {
                    require_once 'conexion.php';
                    $con = conectar();
                    $id = $_GET["id"];
                    $get_producto = "SELECT c.*,p.nombre from compra c INNER JOIN productos p ON c.id_producto = p.id WHERE c.id = $id;";
                    $resultado = mysqli_query($con, $get_producto);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) { ?>
                            <input hidden type="text" value="<?php echo $row['id']; ?>" id="id" name="id" required>
                            <div class="input">
                                <label for="producto">Producto:</label>
                                <input disabled type="text" value="<?php echo $row['nombre']; ?>" id="producto" name="producto" min="0" required>
                            </div>
                            <div class="input">
                                <label for="fecha">Fecha:</label>
                                <input type="text" disabled value="<?php echo date('d/m/Y'); ?>" id="fecha" name="fecha" required>
                            </div>
                            <div class="input">
                                <label for="cantidad" id="unidad_producto">Cantidad:</label>
                                <input type="number" value="<?php echo $row['cantidad']; ?>" id="cantidad" name="cantidad" min="0" required>
                            </div>
                            <div class="input">
                                <label for="precio">Precio:</label>
                                <input type="number" value="<?php echo $row['precio']; ?>" id="valor" name="valor" min="0" required>
                            </div>
                            <button type="submit" id="btn_update_com">Actualizar</button>
                    <?php }
                    } ?>
                <?php } else { ?>
                    <div class="input">
                        <label for="producto">Producto:</label>
                        <select name="producto" id="producto" required>
                            <!-- Generado por ajax list_product -->
                        </select>
                    </div>
                    <div class="input">
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" required>
                    </div>
                    <div class="input">
                        <label for="cantidad" id="unidad_producto">Cantidad:</label>
                        <input type="number" id="cantidad" name="cantidad" min="0" required>
                    </div>
                    <div class="input">
                        <label for="precio">Precio:</label>
                        <input type="number" id="valor" name="valor" min="0" required>
                    </div>
                    <button type="submit" id="add_compra">Crear</button>
                <?php } ?>
            </form>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>