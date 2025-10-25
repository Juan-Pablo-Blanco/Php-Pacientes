<?php


    require_once("header.php");
    require_once("Turno.php");
    require_once("../clase/DBController.php");

    $db_handle = new DBController();

    
    $query = "SELECT id, nombre, apellido FROM pacientes ORDER BY apellido, nombre";
    $pacientes = $db_handle->runQuery($query);

?>

<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <title>Asignar Turno</title>
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

        <h2>Asignar turno</h2>

        <form name="frmAdd" method="post" action="agregar_turno.php" id="frmAdd" onsubmit="return validate();">
            
            <div>
                <label>Paciente</label>
                <span id="paciente-info" class="info"></span>
                <select name="paciente_id" id="paciente_id" class="demoInputBox" required>
                    <option value="">Seleccione un paciente...</option>
                    <?php
                        if (!empty($pacientes)) {
                            foreach ($pacientes as $p) {
                                echo '<option value="' . $p['id'] . '">' . 
                                    htmlspecialchars($p['apellido'] . ', ' . $p['nombre']) . 
                                    '</option>';
                            }
                        } else {
                            echo '<option value="">No hay pacientes registrados</option>';
                        }
                    ?>
            </select>
        </div>

            <div>
                <label>fecha</label>
                <span id="fecha-info" class="info"></span>
                <input type="date" name="fecha_turno" id="fecha_turno" class="demoInputBox" required>
            </div>

            <div>
                <label>hora</label>
                <span id="hora-info" class="info"></span>
                <input type="time" name="hora_turno" id="hora_turno" class="demoInputBox" required>
            </div>

            <div>
                <label>observaciones</label>
                <textarea name="observaciones" id="observaciones" rows="3" class="demoInputBox"></textarea>
            </div>

            <div>
                <label>obra social</label>
                <input type="text" name="obra_social" id="obra_social" class="demoInputBox">
            </div>
        
            <input type="submit" name="add" id="btnSubmit" value="Asignar Turno">

        </form>

        <script>
            function validate() {
                var valid = true;
                $(".demoInputBox").css('background-color','');
                $(".info").html('');

                if(!$("#paciente_id").val()) {
                    $("#paciente-info").html("(requerido)");
                    $("#paciente_id").css('background-color','#FFFFDF');
                    valid = false;
                }
                if(!$("#fecha_turno").val()) {
                    $("#fecha-info").html("(requerido)");
                    $("#fecha_turno").css('background-color','#FFFFDF');
                    valid = false;
                }
                if(!$("#hora_turno").val()) {
                    $("#hora-info").html("(requerido)");
                    $("#hora_turno").css('background-color','#FFFFDF');
                    valid = false;
                }
                return valid;
            }

        </script>

        </body>

</html>

