<?php   require_once "header.php";  ?>

    <div style="text-align:left; margin: 20px 0px 10px;">
        <a id="btnAddAction" href="index.php?action=paciente-add">
            <img src="mainfile/image/icon-add.png" /> Agregar Paciente
        </a>
    </div>

    <div id="patients-grid">
        <table cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha Nacimiento</th>
                    <th>Teléfono</th>
                    <th>Adulto Responsable</th>
                    <th>Motivo Consulta</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($result)): ?>
                    <?php foreach($result as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["nombre"]); ?></td>
                            <td><?php echo htmlspecialchars($row["apellido"]); ?></td>
                            <td><?php echo htmlspecialchars($row["fecha_nacimiento"]); ?></td>
                            <td><?php echo htmlspecialchars($row["telefono"]); ?></td>
                            <td><?php echo htmlspecialchars($row["adulto_responsable"]); ?></td>
                            <td><?php echo htmlspecialchars($row["motivo_consulta"]); ?></td>
                            <td>
                                <a class="btnEditAction" href="index.php?action=paciente-edit&id=<?php echo $row['id']; ?>">
                                    <img src="mainfile/image/icon-edit.png" />
                                </a>
                                <a class="btnDeleteAction" onclick="return confirm('Confirma Eliminar Registro?');"
                                href="index.php?action=paciente-delete&id=<?php echo $row['id']; ?>">
                                    <img src="mainfile/image/icon-delete.png" />
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center;">No hay pacientes registrados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>