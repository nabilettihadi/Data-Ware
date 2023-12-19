<?php

class TeamMemberManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAvailableMembers()
    {
        $members = [];

        $result = mysqli_query($this->conn, "SELECT id_user, First_name, Last_name FROM users WHERE id_equip IS NULL AND role = 'user'");

        while ($row = mysqli_fetch_assoc($result)) {
            $members[] = $row;
        }

        return $members;
    }

    public function addMemberToTeam($teamId, $memberId)
    {
        $query = "UPDATE users SET id_equip = '$teamId' WHERE id_user = '$memberId'";
        $result = mysqli_query($this->conn, $query);

        return $result;
    }
}

?>
