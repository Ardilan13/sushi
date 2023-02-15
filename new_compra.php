<?php require_once 'includes/header.php';
require_once 'includes/auth.php'; ?>
<main>
    <div class="container">
        <div class="header">
            <p>Nueva Compra</p>
        </div>
        <div class="info">
            <form id="new_compra">
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
                    <label for="cantidad" id="unidad_producto">cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad" min="0" required>
                </div>
                <div class="input">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" min="0" required>
                </div>
                <button type="submit" id="add_compra">Crear</button>
            </form>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>