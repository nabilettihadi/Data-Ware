<?php

class TeamManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function removeTeam($teamId, $scrumMasterId)
    {
        $teamId = mysqli_real_escape_string($this->conn, $teamId);
        $scrumMasterId = mysqli_real_escape_string($this->conn, $scrumMasterId);

        // Unset team assignments for users
        $updateUsersQuery = "UPDATE users SET id_equip = NULL WHERE id_equip = $teamId";
        mysqli_query($this->conn, $updateUsersQuery);

        // Unset team assignments for projects
        $updateProjectsQuery = "UPDATE projets SET equipe_id = NULL WHERE equipe_id = $teamId";
        mysqli_query($this->conn, $updateProjectsQuery);

        // Delete the team
        $deleteTeamQuery = "DELETE FROM equipes WHERE id_equipe = $teamId AND scrum_master_id = $scrumMasterId";
        mysqli_query($this->conn, $deleteTeamQuery);

        return true;
    }
}

?>
