<?php   require_once ("header.php");  
        require_once ('../clase/DBController.php');
        require_once ('../clase/turno.php');

        $turnoObj = new Turno();
        $result = $turnoObj->getTodosTurnos();
?>
       
    </div>

    <div id="turnos-grid">
        <table cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Observaciones</th>
                    <th>Obra Social</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($result)): ?>
                    <?php foreach($result as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["paciente_nombre"]); ?></td>
                            <td><?php echo htmlspecialchars($row["fecha_turno"]); ?></td>
                            <td><?php echo htmlspecialchars($row["hora_turno"]); ?></td>
                            <td><?php echo htmlspecialchars($row["observaciones"]); ?></td>
                            <td><?php echo htmlspecialchars($row["obra_social"]); ?></td>
                            <td>
                                <a class="btnEditAction" href="index.php?action=turno-edit&id=<?php echo $row['id']; ?>">
                                    <img src="mainfile/image/icon-edit.png" />
                                </a>
                                <a class="btnDeleteAction" onclick="return confirm('Confirma Eliminar Turno?');"
                                href="index.php?action=turno-delete&id=<?php echo $row['id']; ?>">
                                    <img src="mainfile/image/icon-delete.png" />
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">No hay turnos registrados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

