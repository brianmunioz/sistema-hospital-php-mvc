<?php

require("Basededatos.php");

class TurnosModel{

    private $database;

    public function __construct(){
        $this -> database = new Database();
    }

  
    public function getTurnosMedico($medicoid){
        $conn = $this->database->getConnection();
        $query = "SELECT T.hora, T.dia, U.nombre, U.apellido 
        FROM turnos T 
        JOIN users U ON T.pacienteid = U.id 
        WHERE T.medicoid = $medicoid 
        LIMIT 1";
        

        $result = mysqli_query($conn, $query);
        
        $users = array(); 
        
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row; 
        }
        
        return $users; 
    }
    public function getTurnosPaciente($pacienteid){
        $conn = $this->database->getConnection();
        $query = "SELECT T.hora, T.dia, U.nombre, U.apellido 
        FROM turnos T 
        JOIN users U ON T.medicoid = U.id 
        WHERE T.pacienteid = $pacienteid 
        LIMIT 1";        $result = mysqli_query($conn, $query);
        
        $users = array(); 
        
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row; 
        }
        
        return $users; 
    }
   
    public function createTurno($turno){
        $conn = $this->database->getConnection();
        
        $query = "INSERT INTO turnos (dia, hora, pacienteid, medicoid) VALUES (?, ?, ?, ?)";        
        $statement = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($statement, "ssii", $turno['dia'], $turno['hora'], $turno['pacienteid'], $turno['medicoid']);
        $success = mysqli_stmt_execute($statement);     

        if ($success) {
            return "<div class='alert alert-success' role='alert'>
            Turno creado con éxito!
          </div>";
        } else {
            return "<div class='alert alert-danger' role='alert'>Error al crear turno: " . mysqli_error($conn) . "</div>";
        }
    }
    

    
    
   
}
        
    

    
