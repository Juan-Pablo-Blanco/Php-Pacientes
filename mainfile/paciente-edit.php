<?php
    require_once ("header.php");    
    
?>
   <form name="frmAdd" method="post" action="" id="frmAdd" onsubmit="return validate();">
        <div id="mail-status"></div>

        <div>
            <label style="padding-top: 20px;">Nombre</label>
            <span id="nombre-info" class="info"></span><br />
            <input type="text" name="nombre" id="nombre" class="demoInputBox"
                value="<?php echo isset($result[0]['nombre']) ? $result[0]['nombre'] : ''; ?>">
        </div>

        <div>
            <label>Apellido</label>
            <span id="apellido-info" class="info"></span><br />
            <input type="text" name="apellido" id="apellido" class="demoInputBox"
                value="<?php echo isset($result[0]['apellido']) ? $result[0]['apellido'] : ''; ?>">
        </div>

        <div>
            <label>Fecha de Nacimiento</label>
            <span id="fecha-info" class="info"></span><br />
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="demoInputBox"
                value="<?php echo isset($result[0]['fecha_nacimiento']) ? $result[0]['fecha_nacimiento'] : ''; ?>">
        </div>

        <div>
            <label>Teléfono</label>
            <span id="telefono-info" class="info"></span><br />
            <input type="text" name="telefono" id="telefono" class="demoInputBox"
                value="<?php echo isset($result[0]['telefono']) ? $result[0]['telefono'] : ''; ?>">
        </div>

        <div>
            <label>Adulto Responsable</label>
            <span id="adulto-info" class="info"></span><br />
            <input type="text" name="adulto_responsable" id="adulto_responsable" class="demoInputBox"
                value="<?php echo isset($result[0]['adulto_responsable']) ? $result[0]['adulto_responsable'] : ''; ?>">
        </div>

        <div>
            <label>Motivo de Consulta</label>
            <span id="motivo-info" class="info"></span><br />
            <textarea name="motivo_consulta" id="motivo_consulta" class="demoInputBox"><?php echo isset($result[0]['motivo_consulta']) ? $result[0]['motivo_consulta'] : ''; ?></textarea>
        </div>

        <div>
            <input type="submit" name="add" id="btnSubmit" value="Guardar" />
        </div>
    </form>

    <script src="../js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script>
        function validate() {
            var valid = true;
            $(".demoInputBox").css('background-color', '');
            $(".info").html('');

            if (!$("#nombre").val()) {
                $("#nombre-info").html("(requerido)");
                $("#nombre").css('background-color', '#FFFFDF');
                valid = false;
            }
            if (!$("#apellido").val()) {
                $("#apellido-info").html("(requerido)");
                $("#apellido").css('background-color', '#FFFFDF');
                valid = false;
            }
            if (!$("#fecha_nacimiento").val()) {
                $("#fecha-info").html("(requerido)");
                $("#fecha_nacimiento").css('background-color', '#FFFFDF');
                valid = false;
            }
            if (!$("#telefono").val()) {
                $("#telefono-info").html("(requerido)");
                $("#telefono").css('background-color', '#FFFFDF');
                valid = false;
            }

            return valid;
        }
    </script>
   