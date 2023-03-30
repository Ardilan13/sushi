<?php require_once 'includes/header.php';
require_once 'includes/auth.php';
$id = $_GET['id'] ?? null;
require_once 'conexion.php';
$con = conectar();
$nombre = "SELECT nombre, unidad FROM productos WHERE id = $id;";
$resultado = mysqli_query($con, $nombre);
if ($resultado->num_rows > 0) {
    $row = mysqli_fetch_assoc($resultado);
    $nombre = $row['nombre'];
    if ($row["unidad"] == 1) {
        $und = 'Kgs';
    } else if ($row["unidad"] == 2) {
        $und = 'Lts';
    } else {
        $und = 'Und';
    }
} ?>
<main>
    <div class="container">
        <div class="header">
            <p>Historial <?php echo $nombre; ?></p>
        </div>
        <div class="info">
            <table id="tabla" class="display historial" style="width:100%">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Dia</th>
                        <th>Mes</th>
                        <th>Año</th>
                        <th>Cantidad</th>
                        <th>Motivo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $historial_mov = "SELECT * FROM movimientos WHERE id_producto = $id AND (tipo = 0 OR tipo = 1) ORDER BY fecha DESC;";
                    $resultado = mysqli_query($con, $historial_mov);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $dia = date("d", strtotime($row["fecha"]));
                            $mes = date("m", strtotime($row["fecha"]));
                            $ano = date("Y", strtotime($row["fecha"])); ?>
                            <tr>
                                <td class="status_<?php echo $row['tipo']; ?>">
                                    <?php if ($row["tipo"] == 1) {
                                        echo 'Salida';
                                    } else if ($row["tipo"] == 0) {
                                        echo 'Entrada';
                                    } ?>
                                </td>
                                <td><?php echo $dia; ?></td>
                                <td><?php echo $mes; ?></td>
                                <td><?php echo $ano; ?></td>
                                <td><?php echo $row["cantidad"] . ' ' . $und; ?><span class="cantidad" hidden><?php echo $row["cantidad"]; ?></span></td>
                                <td><b>Movimiento</b></td>
                            </tr>
                        <?php }
                    }

                    $historial_com = "SELECT * FROM compra WHERE id_producto = $id ORDER BY fecha DESC;";
                    $resultado = mysqli_query($con, $historial_com);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $dia = date("d", strtotime($row["fecha"]));
                            $mes = date("m", strtotime($row["fecha"]));
                            $ano = date("Y", strtotime($row["fecha"])); ?>
                            <tr>
                                <td class="status_0">Entrada</td>
                                <td><?php echo $dia; ?></td>
                                <td><?php echo $mes; ?></td>
                                <td><?php echo $ano; ?></td>
                                <td><?php echo $row["cantidad"] . ' ' . $und; ?><span class="cantidad" hidden><?php echo $row["cantidad"]; ?></span></td>
                                <td><b>Compra</b></td>
                            </tr>
                        <?php }
                    }

                    $historial_ven = "SELECT d.fecha,c.* FROM cuentas c INNER JOIN diario d ON d.id = c.id_diario WHERE c.id_preparacion = $id AND tipo = 0 AND d.status = 1 ORDER BY d.fecha DESC;";
                    $resultado = mysqli_query($con, $historial_ven);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $dia = date("d", strtotime($row["fecha"]));
                            $mes = date("m", strtotime($row["fecha"]));
                            $ano = date("Y", strtotime($row["fecha"])); ?>
                            <tr>
                                <td class="status_1">Salida</td>
                                <td><?php echo $dia; ?></td>
                                <td><?php echo $mes; ?></td>
                                <td><?php echo $ano; ?></td>
                                <td><?php echo $row["cantidad"] . ' ' . $und; ?><span class="cantidad" hidden><?php echo $row["cantidad"]; ?></span></td>
                                <td><b>Venta Producto</b></td>
                            </tr>
                        <?php }
                    }

                    $historial_ven = "SELECT d.fecha,c.*,i.id_producto,i.cantidad as receta FROM cuentas c INNER JOIN diario d ON d.id = c.id_diario INNER JOIN ingredientes i ON c.id_preparacion = i.id_preparacion WHERE i.id_producto = $id AND c.tipo = 1 AND d.status = 1 ORDER BY d.fecha DESC;";
                    $resultado = mysqli_query($con, $historial_ven);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $dia = date("d", strtotime($row["fecha"]));
                            $mes = date("m", strtotime($row["fecha"]));
                            $ano = date("Y", strtotime($row["fecha"])); ?>
                            <tr>
                                <td class="status_1">Salida</td>
                                <td><?php echo $dia; ?></td>
                                <td><?php echo $mes; ?></td>
                                <td><?php echo $ano; ?></td>
                                <td><?php echo number_format(($row["cantidad"] * $row["receta"]), 2) . ' ' . $und; ?><span class="cantidad" hidden><?php echo $row["cantidad"]; ?></span></td>
                                <td><b>Venta Receta</b></td>
                            </tr>
                        <?php }
                    }

                    $historial_mov = "SELECT * FROM movimientos WHERE id_producto = $id AND (tipo = 2 OR tipo = 3) ORDER BY fecha DESC;";
                    $resultado = mysqli_query($con, $historial_mov);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $dia = date("d", strtotime($row["fecha"]));
                            $mes = date("m", strtotime($row["fecha"]));
                            $ano = date("Y", strtotime($row["fecha"])); ?>
                            <tr>
                                <?php if ($row["tipo"] == 3) { ?>
                                    <td class="status_1">
                                    <?php } else if ($row["tipo"] == 2) { ?>
                                    <td class="status_0">
                                    <?php } ?>
                                    <?php if ($row["tipo"] == 3) {
                                        echo 'Salida';
                                    } else if ($row["tipo"] == 2) {
                                        echo 'Entrada';
                                    } ?>
                                    </td>
                                    <td><?php echo $dia; ?></td>
                                    <td><?php echo $mes; ?></td>
                                    <td><?php echo $ano; ?></td>
                                    <td><?php echo $row["cantidad"] . ' ' . $und; ?><span class="cantidad" hidden><?php echo $row["cantidad"]; ?></span></td>
                                    <td><b>Preparacion</b></td>
                            </tr>
                        <?php }
                    }

                    $historial_mov = "SELECT * FROM movimientos WHERE id_producto = $id AND (tipo = 4 OR tipo = 5) ORDER BY fecha DESC;";
                    $resultado = mysqli_query($con, $historial_mov);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $dia = date("d", strtotime($row["fecha"]));
                            $mes = date("m", strtotime($row["fecha"]));
                            $ano = date("Y", strtotime($row["fecha"])); ?>
                            <tr>
                                <?php if ($row["tipo"] == 5) { ?>
                                    <td class="status_1">
                                    <?php } else if ($row["tipo"] == 4) { ?>
                                    <td class="status_0">
                                    <?php } ?>
                                    <?php if ($row["tipo"] == 5) {
                                        echo 'Salida';
                                    } else if ($row["tipo"] == 4) {
                                        echo 'Entrada';
                                    } ?>
                                    </td>
                                    <td><?php echo $dia; ?></td>
                                    <td><?php echo $mes; ?></td>
                                    <td><?php echo $ano; ?></td>
                                    <td><?php echo $row["cantidad"] . ' ' . $und; ?><span class="cantidad" hidden><?php echo $row["cantidad"]; ?></span></td>
                                    <td><b>Produccion</b></td>
                            </tr>
                        <?php }
                    }

                    $historial_mov = "SELECT * FROM movimientos WHERE id_producto = $id AND tipo = 6 ORDER BY fecha DESC;";
                    $resultado = mysqli_query($con, $historial_mov);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $dia = date("d", strtotime($row["fecha"]));
                            $mes = date("m", strtotime($row["fecha"]));
                            $ano = date("Y", strtotime($row["fecha"])); ?>
                            <tr>

                                <td class="status_0">Entrada</td>
                                <td><?php echo $dia; ?></td>
                                <td><?php echo $mes; ?></td>
                                <td><?php echo $ano; ?></td>
                                <td><?php echo $row["cantidad"] . ' ' . $und; ?><span class="cantidad" hidden><?php echo $row["cantidad"]; ?></span></td>
                                <td><b>Inicial</b></td>
                            </tr>
                    <?php }
                    }
                    ?>
                </tbody>
            </table>

            <form>
                <div class="input">
                    <label for="inventario">Cantidad total:</label>
                    <input disabled type="text" id="inventario">
                    <button class="edit refresh">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                        </svg>
                    </button>
                </div>
            </form>

        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>