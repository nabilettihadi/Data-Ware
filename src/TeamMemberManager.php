<?php

class TeamMemberManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getTeamMembers($teamId)
    {
        $members = [];

        $result = mysqli_query($this->conn, "SELECT * FROM users WHERE id_equip = $teamId AND role = 'user'");

        while ($row = mysqli_fetch_assoc($result)) {
            $members[] = $row;
        }

        return $members;
    }
}

?>
