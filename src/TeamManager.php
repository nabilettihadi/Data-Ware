<?php

class TeamManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getTeams($scrumMasterId)
    {
        $teams = [];

        $stmt = mysqli_prepare($this->conn, "SELECT * FROM equipes LEFT JOIN users ON equipes.scrum_master_id = users.id_user WHERE scrum_master_id = ?");
        
        if ($stmt === false) {
            die('Error in SQL query: ' . mysqli_error($this->conn));
        }

        mysqli_stmt_bind_param($stmt, "i", $scrumMasterId);
        
        if (!mysqli_stmt_execute($stmt)) {
            die('Error executing query: ' . mysqli_error($this->conn));
        }

        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $teams[] = $row;
        }

        mysqli_stmt_close($stmt);

        return $teams;
    }
}

?>
