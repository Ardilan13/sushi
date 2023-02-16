<?php require_once 'includes/header.php';
require_once 'includes/auth.php'; ?>
<main>
    <div class="container">
        <div class="header">
            <p>Generar Movimiento</p>
        </div>
        <div class="info">
            <form id="new_movimiento">
                <div class="input">
                    <label for="producto">Producto:</label>
                    <select name="producto" id="producto" required>
                        <!-- Generado por ajax list_product -->
                    </select>
                </div>
                <div class="input">
                    <label for="tipo">Tipo:</label>
                    <select name="tipo" id="tipo" required>
                        <option></option>
                        <option value="0">Entrada</option>
                        <option value="1">Salida</option>
                    </select>
                </div>
                <div class="input">
                    <label for="fecha">Fecha:</label>
                    <input type="text" disabled value="<?php echo date('d/m/Y'); ?>" id="fecha" name="fecha" required>
                </div>
                <div class="input">
                    <label for="cantidad" id="unidad_producto">cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad" min="0" required>
                </div>
                <div class="input">
                    <label for="motivo">Motivo:</label>
                    <input type="text" id="motivo" name="motivo" required>
                </div>
                <button type="submit" id="add_movimiento">Crear</button>
            </form>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>