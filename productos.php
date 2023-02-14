<?php require_once 'includes/header.php';
require_once 'includes/auth.php';
require_once 'conexion.php';
$con = conectar(); ?>

<main>
    <div class="container">
        <div class="header">
            <p>Productos</p>
        </div>
        <div class="info">
            <table id="productos" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Proveedor</th>
                        <th>Unidad</th>
                        <th>%</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $login = "SELECT * from productos;";
                    $resultado = mysqli_query($con, $login);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            (float)$merma = $row["merma"] / 100;
                            (float)$total = ($row["cantidad"] * $row["precio"]) + ($row["cantidad"] * $row["precio"]) * $merma; ?>
                            <tr>
                                <td id="<?php echo $row['id']; ?>"><?php echo $row["nombre"]; ?></td>
                                <td class="mid"><?php echo $row["tipo"]; ?></td>
                                <td><?php echo $row["proveedor"]; ?></td>
                                <td class="mid"><?php echo $row["unidad"]; ?></td>
                                <td class="min"><?php echo $row["merma"]; ?></td>
                                <td class="precio"><?php echo number_format($row["precio"]); ?></td>
                                <td class="mid"><?php echo $row["cantidad"]; ?></td>
                                <td class="precio"><?php echo number_format($total); ?></td>
                            </tr>
                    <?php }
                    } else {
                        echo "<td valign='top' colspan='8' class='dataTables_empty'>No hay productos para mostrar</td>";
                    } ?>
                </tbody>
            </table>

            <button hidden id="clonar">clon</button>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>