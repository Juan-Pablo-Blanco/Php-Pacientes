<?php
    require_once("header.php");
    require_once("../clase/DBController.php");

    $db = new DBController();
    $conn = $db->connectDB();

        if (isset($_POST['paciente_id'], $_POST['fecha_turno'], $_POST['hora_turno'])) {

            $paciente_id = $_POST['paciente_id'];
            $fecha_turno = $_POST['fecha_turno'];
            $hora_turno = $_POST['hora_turno'];
            $observaciones = $_POST['observaciones'] ?? null;
            $obra_social = $_POST['obra_social'] ?? null;

            // Verificar que el paciente existe
            $stmtPaciente = $conn->prepare("SELECT id FROM pacientes WHERE id = ? LIMIT 1");
            $stmtPaciente->bind_param("i", $paciente_id);
            $stmtPaciente->execute();
            $result = $stmtPaciente->get_result();

        if ($result->num_rows > 0) {
                // Insertar turno
                $stmt = $conn->prepare("INSERT INTO turnos (paciente_id, fecha_turno, hora_turno, observaciones, obra_social)
                                        VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("issss", $paciente_id, $fecha_turno, $hora_turno, $observaciones, $obra_social);

                if ($stmt->execute()) {
                    echo "<script>alert('Turno asignado correctamente'); window.location='../index.php';</script>";
                } else {
                    echo "<script>alert('Error al asignar el turno');</script>";
                }

                $stmt->close();
        } else {
            echo "<script>alert('Paciente no encontrado.');</script>";
        }

            $stmtPaciente->close();
        } else {
            echo "<script>alert('Faltan datos obligatorios.');</script>";
        }

    $conn->close();
