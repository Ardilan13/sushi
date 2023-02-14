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
                        <th>Edit</th>
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
                                <td class="mid">
                                    <?php if ($row["tipo"] == 1) {
                                        echo 'Abarrotes';
                                    } else if ($row["tipo"] == 2) {
                                        echo 'F & V';
                                    } else if ($row["tipo"] == 3) {
                                        echo 'Peces';
                                    } else if ($row["tipo"] == 4) {
                                        echo 'Carnes';
                                    } else if ($row["tipo"] == 5) {
                                        echo 'Lacteos';
                                    } else {
                                        echo 'Empaque';
                                    } ?>
                                </td>
                                <td><?php echo $row["proveedor"]; ?></td>
                                <td class="mid">
                                    <?php if ($row["unidad"] == 1) {
                                        echo 'Kgs';
                                    } else if ($row["unidad"] == 2) {
                                        echo 'Lts';
                                    } else {
                                        echo 'Und';
                                    } ?>
                                </td>
                                <td class="min"><?php echo $row["merma"]; ?></td>
                                <td class="precio"><?php echo number_format($row["precio"]); ?></td>
                                <td class="mid"><?php echo $row["cantidad"]; ?></td>
                                <td class="precio"><?php echo number_format($total); ?></td>
                                <td class="min edit" id="<?php echo $row["id"]; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="30" height="30" viewBox="0 0 24 24" stroke-width="1" stroke="#ed3456" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                        <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                    </svg>
                                </td>
                            </tr>
                    <?php }
                    } else {
                        echo "<td valign='top' colspan='8' class='dataTables_empty'>No hay productos para mostrar</td>";
                    } ?>
                </tbody>
            </table>
            <button hidden id="clonar">clon</button>

            <div class="botones">
                <button id="new_pro">Nuevo Producto</button>
                <button id="new_com">Nueva Compra</button>
            </div>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>