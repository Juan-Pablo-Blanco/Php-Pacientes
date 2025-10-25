<?php

    require_once ("header.php");
    require_once ("../clase/DBController.php");
    require_once ("../clase/Turno.php");

    $db_handle = new DBController();

    $query = "SELECT id, nombre, apellido FROM pacientes ORDER BY apellido, nombre";
    $pacientes = $db_handle->runQuery($query);


    include_once ("turno-add.php");
