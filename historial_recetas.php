<?php require_once 'includes/header.php';
require_once 'includes/auth.php';
$id = $_GET['id'] ?? null;
require_once 'conexion.php';
$con = conectar();
$nombre = "SELECT nombre, unidad FROM preparaciones WHERE id = $id;";
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
                    <?php $historial_mov = "SELECT * FROM movimientos WHERE id_producto = $id AND tipo = 7 ORDER BY fecha DESC;";
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
                                <td><b>Venta</b></td>
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