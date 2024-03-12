<?php

require("Basededatos.php");

class UsersModel
{

    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getAllUsers()
    {
        $conn = $this->database->getConnection();
        $query = "SELECT * FROM users";
        $result = mysqli_query($conn, $query);

        $users = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }

        return $users;
    }
    public function getMedicos()
    {
        $conn = $this->database->getConnection();
        $query = "SELECT * FROM users WHERE rol='medico'";
        $result = mysqli_query($conn, $query);

        $users = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }

        return $users;
    }
    public function getUser($usuarioid)
    {
        $conn = $this->database->getConnection();
        $query = "SELECT * FROM users WHERE id = $usuarioid limit 1 ";
        $result = mysqli_query($conn, $query);

        $users = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }

        return $users;
    }

    public function getUserbyDNI($DNI)
    {
        $conn = $this->database->getConnection();
        $query = "SELECT * FROM users WHERE dni = $DNI limit 1 ";
        $result = mysqli_query($conn, $query);

        $users = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }

        return $users;
    }
    public function createUser($user)
    {
        $conn = $this->database->getConnection();

        $query = "INSERT INTO users (nombre, apellido, rol, dni, mail, password) VALUES (?, ?, ?, ?, ?, ?)";

        $statement = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($statement, "ssssss", $user['nombre'], $user['apellido'], $user['rol'], $user['dni'], $user['mail'], $user['password']);

        $success = mysqli_stmt_execute($statement);

        if ($success) {
            return "User created successfully";
        } else {
            return "Error creating user: " . mysqli_error($conn);
        }
    }

    public function deleteUser($id)
    {
        $conn = $this->database->getConnection();

        $query = "DELETE FROM users WHERE id = ?";

        $statement = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($statement, "i", $id); // Assuming id is an integer

        $success = mysqli_stmt_execute($statement);

        if ($success) {
            return "User deleted successfully";
        } else {
            return "Error deleting user: " . mysqli_error($conn);
        }
    }

    public function updatePaciente($id, $mail,  $password)
    {
        $conn = $this->database->getConnection();

        $query = "UPDATE users SET mail = ?, password = ? WHERE id = ?";

        $statement = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($statement, "ssi", $mail,  $password, $id); // Assuming id is an integer

        $success = mysqli_stmt_execute($statement);

        if ($success) {
            return "<div class='alert alert-success' role='alert'>
            datos modificado con éxito!!!
          </div>";
        } else {
            return "<div class='alert alert-danger' role='alert'>Error al actualizar tus datos: " . mysqli_error($conn) . "</div>";
        }
    }
    public function updateUser($userData)
    {
        $conn = $this->database->getConnection();

        $query = "UPDATE users SET mail = ?, password = ?, dni = ?, nombre = ?, apellido = ?, rol = ? WHERE dni = ?";

        $statement = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($statement, "ssisssi", $userData["mail"], $userData["password"], $userData["dni"], $userData["nombre"], $userData["apellido"], $userData["rol"], $userData["dni"]);

        $success = mysqli_stmt_execute($statement);

        if ($success) {
            return "<div class='alert alert-success' role='alert'>
            Usuario modificado con éxito!!!
          </div>";
        } else {
            return "<div class='alert alert-danger' role='alert'>Error al actualizar usuario: " . mysqli_error($conn) . "</div>";
        }
    }

}




