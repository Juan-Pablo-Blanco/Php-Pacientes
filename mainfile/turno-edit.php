<?php
    require_once("header.php");
    require_once("../clase/DBController.php");

    $db = new DBController();
    $conn = $db->connectDB();

    // --- Cargar todos los pacientes para el <select> ---
    $pacientes = [];
    $stmtPacientes = $conn->prepare("SELECT id, nombre, apellido FROM pacientes ORDER BY apellido, nombre");
    $stmtPacientes->execute();
    $resultPacientes = $stmtPacientes->get_result();
    while ($row = $resultPacientes->fetch_assoc()) {
        $pacientes[] = $row;
    }
    $stmtPacientes->close();

    // --- Obtener turno por ID ---
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("SELECT * FROM turnos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
    }

    // --- Guardar cambios ---
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $paciente_id = intval($_POST['paciente_id']);
        $fecha_turno = $_POST['fecha_turno'];
        $hora_turno = $_POST['hora_turno'];
        $observaciones = $_POST['observaciones'] ?? null;
        $obra_social = $_POST['obra_social'] ?? null;

        $stmt = $conn->prepare("UPDATE turnos 
                                SET paciente_id = ?, fecha_turno = ?, hora_turno = ?, observaciones = ?, obra_social = ?
                                WHERE id = ?");
        $stmt->bind_param("issssi", $paciente_id, $fecha_turno, $hora_turno, $observaciones, $obra_social, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Turno actualizado correctamente'); window.location='../index.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar el turno');</script>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Turno</title>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f5f5f5;
        }

        form {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            max-width: 450px;
        }

        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        .info {
            color: red;
            font-size: 12px;
        }

        #btnSubmit {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        #btnSubmit:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <h2>Editar turno</h2>

    <form name="frmEdit" method="post" action="" id="frmEdit" onsubmit="return validate();">
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">

        <div>
            <label>Paciente</label>
            <span id="paciente-info" class="info"></span>
            <select name="paciente_id" id="paciente_id" required>
                <option value="">Seleccione un paciente</option>
                <?php foreach ($pacientes as $p): ?>
                    <option value="<?php echo $p['id']; ?>"
                        <?php echo ($p['id'] == $result['paciente_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($p['apellido'] . ", " . $p['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label>Fecha</label>
            <span id="fecha-info" class="info"></span>
            <input type="date" name="fecha_turno" id="fecha_turno"
                value="<?php echo $result['fecha_turno']; ?>" required>
        </div>

        <div>
            <label>Hora</label>
            <span id="hora-info" class="info"></span>
            <input type="time" name="hora_turno" id="hora_turno"
                value="<?php echo $result['hora_turno']; ?>" required>
        </div>

        <div>
            <label>Observaciones</label>
            <textarea name="observaciones" id="observaciones" rows="3"><?php echo htmlspecialchars($result['observaciones']); ?></textarea>
        </div>

        <div>
            <label>Obra Social</label>
            <input type="text" name="obra_social" id="obra_social"
                value="<?php echo htmlspecialchars($result['obra_social']); ?>">
        </div>

        <div>
            <input type="submit" name="edit" id="btnSubmit" value="Guardar Cambios">
        </div>
    </form>

    <script>
        function validate() {
            var valid = true;
            $(".demoInputBox").css('background-color', '');
            $(".info").html('');

            if (!$("#paciente_id").val()) {
                $("#paciente-info").html("(requerido)");
                $("#paciente_id").css('background-color', '#FFFFDF');
                valid = false;
            }
            if (!$("#fecha_turno").val()) {
                $("#fecha-info").html("(requerido)");
                $("#fecha_turno").css('background-color', '#FFFFDF');
                valid = false;
            }
            if (!$("#hora_turno").val()) {
                $("#hora-info").html("(requerido)");
                $("#hora_turno").css('background-color', '#FFFFDF');
                valid = false;
            }

            return valid;
        }
    </script>

</body>

</html>