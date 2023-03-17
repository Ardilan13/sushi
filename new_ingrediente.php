<?php require_once 'includes/header.php';
require_once 'includes/auth.php'; ?>
<main>
    <div class="container">
        <div class="header">
            <?php if (isset($_GET["id"])) { ?>
                <p>Nuevo Ingrediente</p>
            <?php } else if (isset($_GET['ingrediente'])) { ?>
                <p>Editar Ingrediente</p>
            <?php } ?>
        </div>
        <div class="info">
            <form id="new_ingrediente">
                <?php if (isset($_GET["id"])) { ?>
                    <input hidden type="text" value="<?php echo $_GET["id"]; ?>" name="id" id="id_preparacion">
                    <div class="input">
                        <label for="producto">Producto:</label>
                        <select name="producto" id="producto" required></select>
                    </div>
                    <div class="input">
                        <label for="cantidad" id="unidad_producto">Cantidad:</label>
                        <input type="number" id="cantidad" name="cantidad" min="0" step="0.01" required>
                    </div>
                    <div class="input">
                        <label for="valor">Precio:</label>
                        <input type="number" id="valor" name="valor" step="0.01" min="0" required>
                    </div>
                    <button id="add_ing">Nuevo Ingrediente</button>
                    <?php } else if (isset($_GET['ingrediente'])) {
                    require_once 'conexion.php';
                    $con = conectar();
                    $ingrediente = $_GET['ingrediente'];
                    $get_ingrediente = "SELECT (SELECT nombre FROM productos WHERE id = id_producto) as producto,(SELECT precio FROM productos WHERE id = id_producto) as precio,cantidad, valor, id, id_preparacion from ingredientes WHERE id = $ingrediente;";
                    $resultado = mysqli_query($con, $get_ingrediente);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) { ?>
                            <input hidden type="text" value="<?php echo $_GET["ingrediente"]; ?>" name="ingrediente">
                            <input hidden type="number" value="<?php echo $row['precio']; ?>" id="precio" name="precio" min="0" required>
                            <input hidden type="number" value="<?php echo $row['id_preparacion']; ?>" id="preparacion" name="preparacion" required>

                            <div class="input">
                                <label for="producto1">Producto:</label>
                                <input disabled type="text" value="<?php echo $row['producto']; ?>">
                            </div>
                            <div class="input">
                                <label for="cantidad" id="unidad_producto">Cantidad:</label>
                                <input type="number" precio="<?php echo $row['precio']; ?>" value="<?php echo $row['cantidad']; ?>" id="cantidad" name="cantidad" min="0" required>
                            </div>
                            <div class="input">
                                <label for="valor">Precio:</label>
                                <input type="number" id="valor" name="valor" value="<?php echo $row['valor']; ?>" min="0">
                            </div>
                            <button id="update_ing">Actualizar Ingrediente</button>
                    <?php }
                    } ?>
                <?php } ?>
            </form>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>