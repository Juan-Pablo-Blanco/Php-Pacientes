<?php
    
    require_once('DBController.php');

// Se crea la clase Turno

    class Turno
    {
        private $db_handle;

        public function __construct() {
            $this->db_handle = new DBController();
        }

    // --- Agregar Turno ---

        public function agregarTurno($paciente_id, $fecha_turno, $hora_turno, $observaciones, $obra_social) {
            $query = "INSERT INTO turnos (paciente_id, fecha_turno, hora_turno, observaciones, obra_social)
                    VALUES (?, ?, ?, ?, ?)";
            $paramType = "issss";
            $paramValue = [$paciente_id, $fecha_turno, $hora_turno, $observaciones, $obra_social];
            return $this->db_handle->insert($query, $paramType, $paramValue);
        }

    // --- Editar Turno ---

        public function editarTurno($id, $paciente_id, $fecha_turno, $hora_turno, $observaciones, $obra_social) {
            $query = "UPDATE turnos 
                    SET paciente_id = ?, fecha_turno = ?, hora_turno = ?, observaciones = ?, obra_social = ? 
                    WHERE id = ?";
            $paramType = "issssi";
            $paramValue = [$paciente_id, $fecha_turno, $hora_turno, $observaciones, $obra_social, $id];
            return $this->db_handle->update($query, $paramType, $paramValue);
        }

    // --- Eliminar Turno ---

        public function eliminarTurno($id) {
            $query = "DELETE FROM turnos WHERE id = ?";
            $paramType = "i";
            $paramValue = [$id];
            return $this->db_handle->update($query, $paramType, $paramValue);
        }

    // --- Obtener todos los Turnos ---

        public function getTodosTurnos() {
            $query = "
                SELECT 
                    t.id,
                    t.paciente_id,
                    DATE_FORMAT(t.fecha_turno, '%d/%m/%Y') AS fecha_turno,
                    t.hora_turno,
                    t.observaciones,
                    t.obra_social,
                    CONCAT(p.nombre, ' ', p.apellido) AS paciente_nombre
                FROM turnos t
                INNER JOIN pacientes p ON p.id = t.paciente_id
                ORDER BY t.fecha_turno DESC, t.hora_turno DESC
            ";
            $result = $this->db_handle->runQuery($query);
            return $result;
        }

    // --- Obtener un Turno por ID ---

        public function getTurnoPorId($id) {
            $query = "
                SELECT 
                    t.*,
                    CONCAT(p.nombre, ' ', p.apellido) AS paciente_nombre
                FROM turnos t
                INNER JOIN pacientes p ON p.id = t.paciente_id
                WHERE t.id = ?
            ";
            $paramType = "i";
            $paramValue = [$id];
            return $this->db_handle->runQuery($query, $paramType, $paramValue);
        }
    }
?>