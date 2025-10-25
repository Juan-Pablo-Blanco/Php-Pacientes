<?php

    require_once ("header.php");
    
?>

<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <title>Agregar Pacientes</title>
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
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            max-width: 450px;
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }
        input, textarea {
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

    <h2>Agregar nuevo paciente</h2>

    <form name="frmAdd" method="post" action="mainfile/agregar_paciente.php" id="frmAdd" onsubmit="return validate();">
        <div>
            <label>Nombre</label>
            <span id="nombre-info" class="info"></span>
            <input type="text" name="nombre" id="nombre" class="demoInputBox" required>
        </div>

        <div>
            <label>Apellido</label>
            <span id="apellido-info" class="info"></span>
            <input type="text" name="apellido" id="apellido" class="demoInputBox" required>
        </div>

        <div>
            <label>Fecha de nacimiento</label>
            <span id="fecha-info" class="info"></span>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="demoInputBox" required>
        </div>

        <div>
            <label>Teléfono</label>
            <span id="telefono-info" class="info"></span>
            <input type="number" name="telefono" id="telefono" class="demoInputBox">
        </div>

        <div>
            <label>Adulto responsable</label>
            <input type="text" name="adulto_responsable" id="adulto_responsable" class="demoInputBox">
        </div>

        <div>
            <label>Motivo de consulta</label>
            <textarea name="motivo_consulta" id="motivo_consulta" rows="3" class="demoInputBox"></textarea>
        </div>

        <input type="submit" name="add" id="btnSubmit" value="Agregar Paciente">
    </form>

    <script>
    function validate() {
        var valid = true;
        $(".demoInputBox").css('background-color','');
        $(".info").html('');

        if(!$("#nombre").val()) {
            $("#nombre-info").html("(requerido)");
            $("#nombre").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#apellido").val()) {
            $("#apellido-info").html("(requerido)");
            $("#apellido").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#fecha_nacimiento").val()) {
            $("#fecha-info").html("(requerido)");
            $("#fecha_nacimiento").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#telefono").val()) {
            $("#telefono-info").html("(requerido)");
            $("#telefono").css('background-color','#FFFFDF');
            valid = false;
        }

        return valid;
    }
    </script>

    </body>
</html>



