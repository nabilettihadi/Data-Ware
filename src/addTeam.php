<?php
class TeamManager
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function createTeam($name, $dateCreation, $scrumMasterId)
    {
        $name = mysqli_real_escape_string($this->conn, $name);
        $dateCreation = mysqli_real_escape_string($this->conn, $dateCreation);
        $scrumMasterId = mysqli_real_escape_string($this->conn, $scrumMasterId);

        $query = "INSERT INTO equipes (Name_equipe, date_creation, scrum_master_id) VALUES ('$name', '$dateCreation', '$scrumMasterId')";
        $result = mysqli_query($this->conn, $query);

        return $result;
    }
}

?>
