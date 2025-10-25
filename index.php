<?php

    require_once("clase/DBController.php");
    require_once("clase/paciente.php");
    require_once("mainfile/header.php");



    $db_handle = new DBController();


    if (!empty($_GET["action"])) {
        $action = $_GET["action"];
    } else {
        $action = "list-pacientes";
    }

    switch ($action) {

        // --------------- AGREGAR PACIENTE ---------------
        case "paciente-add":
            if (isset($_POST['add'])) {
                // ... tu código para agregar paciente
            }
            require_once "mainfile/paciente-add.php";
            break;

        // --------------- EDITAR PACIENTE ---------------
        case "paciente-edit":
            // ... tu código para editar paciente
            require_once "mainfile/paciente-edit.php";
            break;

        // --------------- ELIMINAR PACIENTE ---------------
        case "paciente-delete":
            // ... tu código para eliminar paciente
            require_once "mainfile/paciente.php";
            break;

        // --------------- LISTAR PACIENTES ---------------
        case "list-pacientes":
            $paciente = new Paciente();
            $result = $paciente->getAllPaciente();
            require_once "mainfile/paciente.php";
            break;

        // --------------- LISTAR TURNOS ---------------
        case "turno-list":
            require_once "clase/Turno.php";
            $turno = new Turno();
            $result = $turno->getTodosTurnos();
            require_once "mainfile/turno.php";
            break;

        // --------------- DEFAULT ---------------
        default:
            $paciente = new Paciente();
            $result = $paciente->getAllPaciente();
            require_once "mainfile/paciente.php";
            break;
        
    }


echo '<a href="mainfile/asignar_turno.php">Asignar Turno</a>';
