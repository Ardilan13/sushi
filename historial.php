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
            <table id="tabla" class="display" style="width:100%">
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
                    $historial_mov = "SELECT * FROM movimientos WHERE id_producto = $id ORDER BY fecha DESC;";
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
                                <td><?php echo number_format($row["cantidad"], 2) . ' ' . $und; ?></td>
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
                                <td><?php echo number_format($row["cantidad"], 2) . ' ' . $und; ?></td>
                                <td><b>Compra</b></td>
                            </tr>
                        <?php }
                    }

                    $historial_ven = "SELECT d.fecha,c.* FROM cuentas c INNER JOIN diario d ON d.id = c.id_diario WHERE c.id_preparacion = $id ORDER BY d.fecha DESC;";
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
                                <td><?php echo number_format($row["cantidad"], 2) . ' ' . $und; ?></td>
                                <td><b>Venta</b></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
            <button hidden id="clonar">clon</button>

        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>