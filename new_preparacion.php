<?php require_once 'includes/header.php';
require_once 'includes/auth.php'; ?>
<main>
    <div class="container">
        <div class="header">
            <?php if (isset($_GET["id"])) { ?>
                <p>Editar Preparacion</p>
            <?php } else { ?>
                <p>Nueva Preparacion</p>
            <?php } ?>
        </div>
        <div class="info">
            <form id="new_preparacion">
                <?php if (isset($_GET["id"])) {
                    require_once 'conexion.php';
                    $con = conectar();
                    $id = $_GET["id"];
                    $get_preparacion = "SELECT * from preparaciones WHERE id = $id;";
                    $resultado = mysqli_query($con, $get_preparacion);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) { ?>
                            <input hidden type="text" id="id" name="id" value="<?php echo $id; ?>" required>
                            <div class="input">
                                <label for="nombre">Nombre:</label>
                                <input disabled value="<?php echo $row['nombre']; ?>" type="text" id="nombre" name="nombre" required>
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
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $get_preparacion = "SELECT (SELECT nombre FROM productos WHERE id = id_producto) as producto,cantidad, valor, id from ingredientes WHERE id_preparacion = $id;";
                                    $resultado = mysqli_query($con, $get_preparacion);
                                    if ($resultado->num_rows > 0) {
                                        while ($row1 = mysqli_fetch_assoc($resultado)) { ?>
                                            <tr>
                                                <td><?php echo $row1['producto']; ?></td>
                                                <td class="mid"><?php echo $row1['cantidad']; ?></td>
                                                <td id="valor_ing"><?php echo $row1['valor']; ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                            <button hidden id="clonar">clon</button>

                            <div class="input">
                                <label for="valor">Valor:</label>
                                <input disabled value="<?php echo $row['valor']; ?>" type="text" id="valor" name="nombre" required>
                            </div>

                            <button id="new_ing">Nuevo Ingrediente</button>
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
                            <option value="1">Preparacion</option>
                            <option value="2">Receta</option>
                        </select>
                    </div>
                    <button type="submit" id="add_preparacion">Crear</button>
                <?php } ?>
            </form>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>