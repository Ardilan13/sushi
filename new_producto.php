<?php require_once 'includes/header.php';
require_once 'includes/auth.php';
require_once 'conexion.php';
$con = conectar(); ?>
<main>
    <div class="container">
        <div class="header">
            <?php if (isset($_GET["id"])) { ?>
                <p>Editar Producto</p>
            <?php } else { ?>
                <p>Nuevo Producto</p>
            <?php } ?>
        </div>
        <div class="info">
            <form id="new_producto">
                <?php if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $get_producto = "SELECT * from productos WHERE id = $id;";
                    $resultado = mysqli_query($con, $get_producto);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) { ?>
                            <input hidden type="text" id="id" name="id" value="<?php echo $id; ?>" required>
                            <div class="input">
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" value="<?php echo $row["nombre"]; ?>" required>
                            </div>
                            <div class="input">
                                <label for="tipo">Tipo:</label>
                                <select name="tipo" id="tipo" required>
                                    <option></option>
                                    <?php $tipo = "SELECT * from tipo";
                                    $resultado2 = mysqli_query($con, $tipo);
                                    if ($resultado2->num_rows > 0) {
                                        while ($row2 = mysqli_fetch_assoc($resultado2)) { ?>
                                            <option <?php if ($row2['id'] == $row['tipo']) {
                                                        echo ' selected';
                                                    } ?> value="<?php echo $row2['id'] ?>"> <?php echo $row2['nombre'] ?> </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="input">
                                <label for="proveedor">Proveedor:</label>
                                <input type="text" id="proveedor" name="proveedor" value="<?php echo $row["proveedor"]; ?>" required>
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
                                <label for="merma">Merma:</label>
                                <input type="number" id="merma" name="merma" value="<?php echo $row["merma"]; ?>" min="0" max="100" required>
                            </div>
                            <div class="input">
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" id="cantidad" disabled name="cantidad" value="<?php echo $row["cantidad"]; ?>" min="0" required>
                            </div>
                            <div class="input">
                                <label for="precio">Precio:</label>
                                <input type="number" id="precio" disabled name="precio" value="<?php echo $row["precio"]; ?>" min="0" required>
                            </div>
                            <button type="submit" class="edit" id="btn_producir">Producir</button>
                            <button type="submit" id="btn_update_pro">Actualizar</button>
                    <?php }
                    } ?>
                <?php } else { ?>
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
                        <label for="proveedor">Proveedor:</label>
                        <input type="text" id="proveedor" name="proveedor" required>
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
                        <label for="merma">Merma:</label>
                        <input type="number" id="merma" name="merma" min="0" max="100" required>
                    </div>
                    <div class="input">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" id="cantidad" name="cantidad" min="0" required>
                    </div>
                    <div class="input">
                        <label for="precio">Precio:</label>
                        <input type="number" id="precio" name="precio" min="0" required>
                    </div>
                    <button type="submit" id="add_producto">Crear</button>
                <?php } ?>
            </form>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>