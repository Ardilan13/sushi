<?php require_once '../conexion.php';
$con = conectar();

$list = "SELECT id,nombre,unidad from productos ORDER BY nombre ASC;";
$resultado = mysqli_query($con, $list);
if ($resultado->num_rows > 0) { ?>
    <option></option>
    <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
        <option value="<?php echo $row['id']; ?>" unidad="<?php echo $row['unidad']; ?>"><?php echo $row['nombre']; ?></option>
    <?php }
} else { ?>
    <option>No hay productos disponibles</option>
<?php } ?>