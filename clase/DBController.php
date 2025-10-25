<?php

class DBController
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "pacientes_db";
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connectDB();
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function connectDB()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        return $conn;
    }

    function runBaseQuery($query)
    {
        $resultset = array();
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        return $resultset;
    }
    
    
    private function bindQueryParams($stmt, $param_type, $param_value_array)
    {
        if (!empty($param_type) && !empty($param_value_array)) {
            $param_value_reference = array();
            $param_value_reference[] = &$param_type;

            foreach ($param_value_array as $key => $value) {
                $param_value_reference[] = &$param_value_array[$key];
            }

            call_user_func_array(array($stmt, 'bind_param'), $param_value_reference);
        }
    }

    function runQuery($query, $param_type = "", $param_value_array = array())
    {
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            die("Error en prepare: " . $this->conn->error);
        }

        $this->bindQueryParams($stmt, $param_type, $param_value_array);
        $stmt->execute();

        $result = $stmt->get_result();
        $resultset = array();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        return $resultset;
    }

    function insert($query, $param_type = "", $param_value_array = array())
    {
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Error en prepare: " . $this->conn->error);
        }

        $this->bindQueryParams($stmt, $param_type, $param_value_array);
        $stmt->execute();
        return $stmt->insert_id;
    }

    function update($query, $param_type = "", $param_value_array = array())
    {
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Error en prepare: " . $this->conn->error);
        }

        $this->bindQueryParams($stmt, $param_type, $param_value_array);
        $stmt->execute();
    }
}
