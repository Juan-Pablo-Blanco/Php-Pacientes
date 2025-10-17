<?php
    
    require_once ('DBController.php');

    class Paciente
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addPaciente($nombre, $apellido, $fecha_nacimiento, $telefono, $adulto_responsable, $motivo_consulta) {
        $query = "INSERT INTO pacientes (nombre, apellido, fecha_nacimiento, telefono, adulto_responsable, motivo_consulta)
                VALUES (?, ?, ?, ?, ?, ?)";
        // Orden: nombre(s), apellido(s), fecha_nacimiento(s), telefono(i), adulto_responsable(s), motivo_consulta(s)
        $paramType = "sssiss";
        
        $paramValue = array(
            $nombre,
            $apellido,
            $fecha_nacimiento,
            $telefono,
            $adulto_responsable,
            $motivo_consulta
        );
    
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        
        return $insertId;
    }

    
    function editPaciente($id, $nombre, $apellido, $fecha_nacimiento, $telefono, $adulto_responsable, $motivo_consulta) {
        $query = "UPDATE pacientes 
                SET nombre = ?, 
                    apellido = ?, 
                    fecha_nacimiento = ?, 
                    telefono = ?, 
                    adulto_responsable = ?, 
                    motivo_consulta = ? 
                WHERE id = ?";
        
        $paramType = "ssssssi";

        $paramValue = array(
            $id,
            $nombre,
            $apellido,
            $fecha_nacimiento,
            $telefono,
            $adulto_responsable,
            $motivo_consulta
            
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function deletePaciente($id) {
        $query = "DELETE FROM pacientes WHERE id = ?";
        $paramType = "i";
        $paramValue = array($id);

        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getPacienteById($id) {
        $query = "SELECT * FROM pacientes WHERE id = ?";
        $paramType = "i";
        $paramValue = array($id);
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        
        return $result;
    }
    
    function getAllPaciente() {
        $sql = "SELECT * FROM pacientes ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function searchPaciente($nombre) {
        $query = "SELECT * FROM pacientes WHERE nombre LIKE ?";
        $paramType = "s";
        $paramValue = array("%$nombre%");
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        
        return $result;
    }


}



?>