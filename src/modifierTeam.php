<?php

class TeamManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function updateTeam($teamId, $name, $date)
    {
        $teamId = mysqli_real_escape_string($this->conn, $teamId);
        $name = mysqli_real_escape_string($this->conn, $name);
        $date = mysqli_real_escape_string($this->conn, $date);

        $updateQuery = "UPDATE equipes SET Name_equipe='$name', date_creation='$date' WHERE id_equipe=$teamId";
        $query = mysqli_query($this->conn, $updateQuery);

        return $query;
    }
}

?>
