<?php 

    require_once ("clase/DBController.php");
    require_once ("clase/paciente.php");
    require_once ("mainfile/header.php");


    $db_handle = new DBController();


    if (!empty($_GET["action"])) {
        $action = $_GET["action"];
    } else {
        $action = "list-pacientes";
    }

    switch ($action) {

        // ---------------  AGREGAR PACIENTE --------------- 
        case "paciente-add":
            if (isset($_POST['add'])) {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $fecha_nacimiento = "";
                if (!empty($_POST['fecha_nacimiento'])) {
                    $fecha_timestamp = strtotime($_POST["fecha_nacimiento"]);
                    $fecha_nacimiento = date("Y-m-d", $fecha_timestamp);
                }
                $telefono = $_POST['telefono'];
                $adulto_responsable = $_POST['adulto_responsable'] ?? null;
                $motivo_consulta = $_POST['motivo_consulta'] ?? null;

                $paciente = new Paciente();
                $insertId = $paciente->addPaciente($nombre, $apellido, $fecha_nacimiento, $telefono, $adulto_responsable, $motivo_consulta);

                if (empty($insertId)) {
                    $response = array(
                        "message" => "Problema al agregar un nuevo paciente",
                        "type" => "error"
                    );
                } else {
                    header("Location: index.php?action=list-pacientes");
                }
            }
            require_once "mainfile/paciente-add.php";
            break;

        // --------------- EDITAR PACIENTE --------------- 
        case "paciente-edit":
            $paciente_id = $_GET["id"];
            $paciente = new Paciente();

            if ($paciente_id <= 0) {
                echo "ID de paciente no definido o inválido.";
                exit;
            }

            if (isset($_POST['add'])) {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $fecha_nacimiento = !empty($_POST['fecha_nacimiento']) ? date("Y-m-d", strtotime($_POST["fecha_nacimiento"])) : "";
                $telefono = $_POST['telefono'];
                $adulto_responsable = $_POST['adulto_responsable'] ?? null;
                $motivo_consulta = $_POST['motivo_consulta'] ?? null;

                $paciente->editPaciente($nombre, $apellido, $fecha_nacimiento, $telefono, $adulto_responsable, $motivo_consulta, $paciente_id);
                header("Location: index.php?action=list-pacientes");
                exit;
            }

            $result = $paciente->getPacienteById($paciente_id);
            require_once "mainfile/paciente-edit.php";
            break;

        // ---------------  ELIMINAR PACIENTE --------------- 
        case "paciente-delete":
            $paciente_id = $_GET["id"];
            $paciente = new Paciente();
            $paciente->deletePaciente($paciente_id);

            $result = $paciente->getAllPaciente();
            require_once "mainfile/paciente.php";
            break;

        // ---------------  LISTAR PACIENTES --------------- 
        case "list-pacientes":
            $paciente = new Paciente();
            $result = $paciente->getAllPaciente();
            require_once "mainfile/paciente.php";
            break;

        // --------------- DEFAULT --------------- 
        default:
            $paciente = new Paciente();
            $result = $paciente->getAllPaciente();
            require_once "mainfile/paciente.php";
            break;
    }
?>