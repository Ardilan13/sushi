<?php require_once 'includes/header.php';
require_once 'includes/auth.php';
require_once 'conexion.php';
$con = conectar(); ?>
<main>
    <div class="container">
        <div class="header">
            <p>Preparaciones y Recetas</p>
        </div>
        <div class="info">
            <table id="tabla" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th class="mid">Codigo</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Valor</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    /* $login = "SELECT p.nombre as producto,p.unidad,m.tipo,m.fecha, m.cantidad, m.motivo FROM movimientos m join productos p on m.id_producto = p.id;";*/
                    /*                     $login = "SELECT DISTINCT p.id,p.nombre,p.valor,p.tipo,(SELECT COUNT(DISTINCT id_producto) FROM ingredientes where p.id = id_preparacion) as productos FROM preparaciones p JOIN ingredientes i ON p.id = i.id_preparacion ORDER BY p.id DESC;";  */
                    $login = "SELECT * FROM preparaciones ORDER BY id DESC";
                    $resultado = mysqli_query($con, $login);
                    if ($resultado->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            if ($row["unidad"] == 1) {
                                $und = 'Kgs';
                            } else if ($row["unidad"] == 2) {
                                $und = 'Lts';
                            } else  if ($row["unidad"] == 3) {
                                $und = 'Und';
                            } else {
                                $und = null;
                            } ?>
                            <tr>
                                <td><?php echo $row["id"]; ?></td>
                                <td><?php echo $row["nombre"]; ?></td>
                                <td>
                                    <?php if ($row["tipo"] == 1) {
                                        echo 'Preparación';
                                    } else if ($row["tipo"] == 2) {
                                        echo 'Receta';
                                    } ?>
                                </td>
                                <td><?php echo number_format($row["cantidad"], 1) . $und; ?></td>
                                <td><?php echo number_format($row["valor"], 2); ?></td>
                                <td class="mid">
                                    <button class="edit edit_pre" id="<?php echo $row["id"]; ?>">
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
                <button class="new_pre">Nueva Preparacion</button>
            </div>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>