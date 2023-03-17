<?php require_once 'includes/header.php';
require_once 'includes/auth.php';
$id = $_GET["id"];
require_once 'conexion.php';
$con = conectar(); ?>
<main>
    <div class="container">
        <div class="header">
            <?php if (isset($_GET["id"])) { ?>
                <p>Agregar Preparacion</p>
            <?php } ?>
        </div>
        <div class="info">
            <form id="new_preparacion_receta">
                <?php if (isset($_GET["id"])) { ?>
                    <input hidden type="text" value="<?php echo $_GET["id"]; ?>" name="id">
                    <div class="input">
                        <label for="preparacion">Preparacion:</label>
                        <select name="preparacion" id="preparacion" required>
                            <option></option>
                            <?php $get_preparacion = "SELECT nombre,id,unidad FROM preparaciones WHERE tipo = 1";
                            $resultado = mysqli_query($con, $get_preparacion);
                            if ($resultado->num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($resultado)) { ?>
                                    <option unidad="<?php echo $row['unidad'] ?>" value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="input">
                        <label for="cantidad_pre" id="unidad_producto">Cantidad:</label>
                        <input type="number" id="cantidad_pre" name="cantidad" min="0" required>
                    </div>
                    <div class="input">
                        <label for="valor_pre">Valor:</label>
                        <input type="number" id="valor_pre" name="valor" min="0" required>
                    </div>
                    <button id="add_pre">Agregar</button>
                <?php } ?>
            </form>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>