<?php require_once 'includes/header.php';
require_once 'includes/auth.php';
require_once 'conexion.php';
$con = conectar(); ?>
<main>
    <div class="container">
        <div class="header">
            <p>Ventas</p>
        </div>
        <div class="info">
            <table id="tabla" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th class="mid">ID</th>
                        <th>Estado</th>
                        <th>Dia</th>
                        <th>Mes</th>
                        <th>Año</th>
                        <th>Valor</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $login = "SELECT * FROM diario ORDER BY id DESC";
                    $resultado = mysqli_query($con, $login);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $dia = date("d", strtotime($row["fecha"]));
                            $mes = date("m", strtotime($row["fecha"]));
                            $ano = date("Y", strtotime($row["fecha"])); ?>
                            <tr>
                                <td><?php echo $row["id"]; ?></td>
                                <td><?php echo $row["status"] != 1 ? 'Abierto' : 'Cerrado'; ?></td>
                                <td><?php echo $dia; ?></td>
                                <td><?php echo $mes; ?></td>
                                <td><?php echo $ano; ?></td>
                                <td><?php echo number_format($row["valor"], 2); ?></td>
                                <td class="mid">
                                    <button class="edit edit_ventas" id="<?php echo $row["id"]; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                            <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                        </svg>
                                    </button>
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
                <button class="new_ven">Nueva Venta</button>
            </div>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>