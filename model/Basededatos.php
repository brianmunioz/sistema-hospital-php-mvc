<?php
if (!class_exists('Database')) {

class Database {
    private $servername = "127.0.0.1:4500";
    private $username = "root";
    private $password = "";
    private $dbname = "hospital";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }
    public function getConnection() {
        return $this->conn;
    }
}}