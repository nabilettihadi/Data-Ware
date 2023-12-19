<?php
class Database {
    private $servername = "localhost";
    private $database = "dataware_v3";
    private $username = "root";
    private $password = "";
    private $conn;

    // Constructor
    public function __construct() {
        $this->connect();
    }

    // Connect to the database
    private function connect() {
        // Check if connection already exists
        if (!isset($this->conn)) {
            // Establish the database connection
            $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);

            // Check connection
            if (!$this->conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
        }
    }

    // Get the database connection
    public function getConnection() {
        return $this->conn;
    }

    // Destructor - close the connection when the object is destroyed
    public function __destruct() {
        // No need to close the connection here, as it should be closed automatically at the end of your script.
    }
}

?>