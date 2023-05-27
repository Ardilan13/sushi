<?php require_once 'includes/header.php';
require_once 'includes/auth.php';
require_once 'conexion.php';
$con = conectar(); ?>
<main>
    <div class="container">
        <div class="header">
            <p>Preparaciones</p>
        </div>
        <div class="info">
            <table id="tabla" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th class="mid">Codigo</th>
                        <th>Nombre</th>
                        <th>Valor</th>
                        <?php if ($_SESSION["id"] == 'admin') { ?>
                            <th>Edit</th>
                            <th>Borrar</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $preparaciones = "SELECT * FROM preparaciones WHERE tipo = 1 ORDER BY id DESC";
                    $resultado = mysqli_query($con, $preparaciones);
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
                                <td><?php echo number_format($row["valor"], 3); ?></td>
                                <?php if ($_SESSION["id"] == 'admin') { ?>
                                    <td class="min">
                                        <button class="edit edit_pre" id="<?php echo $row["id"]; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                                <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                            </svg>
                                        </button>
                                    </td>
                                    <td class="min">
                                        <button class="edit delete_pre" id="<?php echo $row["id"]; ?>" name="<?php echo $row["nombre"]; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <line x1="4" y1="7" x2="20" y2="7" />
                                                <line x1="10" y1="11" x2="10" y2="17" />
                                                <line x1="14" y1="11" x2="14" y2="17" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </td>
                                <?php } ?>

                            </tr>
                    <?php }
                    } else {
                        echo "<td valign='top' colspan='8' class='dataTables_empty'>No hay preparaciones para mostrar</td>";
                    } ?>
                </tbody>
            </table>
            <button hidden id="clonar">clon</button>

            <div class="botones">
                <?php if ($_SESSION["id"] == 'admin') { ?>
                    <button class="new_pre">Nueva Preparacion</button>
                    <button class="edit act_valores">Actualizar Valores</button>
                <?php } ?>
            </div>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>