<?php require_once 'includes/header.php';
require_once 'includes/auth.php';
require_once 'conexion.php';
$con = conectar(); ?>
<main>
    <div class="container">
        <div class="header">
            <?php if (isset($_GET["id"])) { ?>
                <p>Editar Tipo</p>
            <?php } else { ?>
                <p>Nuevo Tipo</p>
            <?php } ?>
        </div>
        <div class="info">
            <form id="new_tipos">
                <?php if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $get_producto = "SELECT * from tipo WHERE id = $id;";
                    $resultado = mysqli_query($con, $get_producto);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) { ?>
                            <input hidden type="text" id="id" name="id" value="<?php echo $id; ?>" required>
                            <div class="input">
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" value="<?php echo $row["nombre"]; ?>" required>
                            </div>
                            <button type="submit" id="btn_update_tipo">Actualizar</button>
                    <?php }
                    } ?>
                <?php } else { ?>
                    <div class="input">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre">
                    </div>
                    <button type="submit" id="add_tipo">Crear</button>
                <?php } ?>
            </form>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>