<?php

require("Basededatos.php");

class FichasModel{

    private $database;

    public function __construct(){
        $this -> database = new Database();
    }

    public function getAllFichas(){
        $conn = $this->database->getConnection();
        $query = "SELECT * FROM fichas E JOIN users D ON E.pacienteid = D.Id ";
        $result = mysqli_query($conn, $query);
        
        $users = array(); 
        
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row; 
        }
        
        return $users; 
    }

    public function getFicha($pacienteid){
        $conn = $this->database->getConnection();
        $query = "SELECT E.medicamentos,E.diagnosticos, E.tratamientos, E.alergias, D.dni, D.nombre, D.apellido, D.id FROM fichas E JOIN users D ON E.pacienteid = D.Id where E.pacienteid = $pacienteid";
        $result = mysqli_query($conn, $query);
        
        $users = array(); 
        
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row; 
        }
        
        return $users; 
    }
   
    public function createFicha($user){
        $conn = $this->database->getConnection();
        
        $query = "INSERT INTO fichas (alergias, diagnosticos, tratamientos, medicamentos, pacienteid) VALUES (?, ?, ?, ?, ?)";
        
        $statement = mysqli_prepare($conn, $query);
        
        mysqli_stmt_bind_param($statement, "ssssi", $user['alergias'], $user['diagnosticos'], $user['tratamientos'], $user['medicamentos'], $user['pacienteid']);
        
        $success = mysqli_stmt_execute($statement);
        
        if ($success) {
            return "<div class='alert alert-success' role='alert'>
            Ficha creada con éxito!
          </div>";
                } else {
                    return "<div class='alert alert-danger' role='alert'>Error al crear ficha: " . mysqli_error($conn) . "</div>";
                }
    }
  
    public function deleteFicha($dni){
        $conn = $this->database->getConnection();
        
        // Prepare the SQL statement using a prepared statement to prevent SQL injection
        $query = "DELETE FROM fichas WHERE dni = ?";
        
        // Prepare the statement
        $statement = mysqli_prepare($conn, $query);
    
        // Bind the parameter
        mysqli_stmt_bind_param($statement, "i", $dni); // Assuming id is an integer
        
        // Execute the statement
        $success = mysqli_stmt_execute($statement);
        
        // Check if the deletion was successful
        if ($success) {
            return "User deleted successfully";
        } else {
            return "Error deleting user: " . mysqli_error($conn);
        }
    }
    
    public function updateFicha($alergias, $diagnosticos, $tratamientos, $medicamentos, $pacienteid){
        $conn = $this->database->getConnection();
        
        // Prepare the SQL statement using a prepared statement to prevent SQL injection
        $query = "UPDATE fichas SET alergias = ?, diagnosticos = ?, tratamientos = ?, medicamentos = ? WHERE pacienteid = ?";
        
        // Prepare the statement
        $statement = mysqli_prepare($conn, $query);
        
        // Bind parameters
        mysqli_stmt_bind_param($statement, "ssssi", $alergias, $diagnosticos, $tratamientos, $medicamentos, $pacienteid); // Assuming id is an integer
        
        // Execute the statement
        $success = mysqli_stmt_execute($statement);
        
        // Check if the update was successful
        if ($success) {
            return "User updated successfully";
        } else {
            return "Error updating user: " . mysqli_error($conn);
        }
    }
   
    
}
        
    

    
