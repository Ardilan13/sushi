<?php require_once 'includes/header.php';
require_once 'includes/auth.php'; ?>
<main>
    <div class="container">
        <div class="header">
            <?php if (isset($_GET["id"])) { ?>
                <p>Nuevo Ingrediente</p>
            <?php } ?>
        </div>
        <div class="info">
            <form id="new_ingrediente">
                <input hidden type="text" value="<?php echo $_GET["id"]; ?>" name="id">
                <div class="input">
                    <label for="producto">Producto:</label>
                    <select name="producto" id="producto" required></select>
                </div>
                <div class="input">
                    <label for="cantidad" id="unidad_producto">Cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad" min="0" required>
                </div>
                <div class="input">
                    <label for="valor">Valor:</label>
                    <input type="number" id="valor" name="valor" min="0" required>
                </div>
                <button id="add_ing">Nuevo Ingrediente</button>
            </form>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>