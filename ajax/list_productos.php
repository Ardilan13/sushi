<?php require_once '../conexion.php';
$con = conectar();

$list = "SELECT id,nombre,unidad from productos;";
$resultado = mysqli_query($con, $list);
if ($resultado->num_rows > 0) { ?>
    <option>Seleccion un producto</option>
    <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
        <option value="<?php echo $row['id']; ?>" unidad="<?php echo $row['unidad']; ?>"><?php echo $row['nombre']; ?></option>
    <?php }
} else { ?>
    <option>No hay productos disponibles</option>
<?php } ?>