<?php

    require_once ("header.php");
    require_once ("../clase/DBController.php");

    $db = new DBController();
    $conn = $db->connectDB();

    if (isset($_POST['nombre'], $_POST['apellido'], $_POST['fecha_nacimiento'], $_POST['telefono'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $telefono = $_POST['telefono'];
        $adulto_responsable = $_POST['adulto_responsable'] ?? null;
        $motivo_consulta = $_POST['motivo_consulta'] ?? null;

        $stmt = $conn->prepare("INSERT INTO pacientes (nombre, apellido, fecha_nacimiento, telefono, adulto_responsable, motivo_consulta)
                            VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $nombre, $apellido, $fecha_nacimiento, $telefono, $adulto_responsable, $motivo_consulta);

        if ($stmt->execute()) {
            echo "<script>alert('Paciente agregado correctamente'); window.location='../index.php';</script>";
        } else {
            echo "<script>alert('Error al agregar paciente');</script>";
        }

        $stmt->close();
    }
?>