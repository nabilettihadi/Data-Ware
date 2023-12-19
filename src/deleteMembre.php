<?php

class UserManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function removeUserFromTeam($userId)
    {
        $userId = mysqli_real_escape_string($this->conn, $userId);

        $updateQuery = "UPDATE users SET id_equip = NULL WHERE id_user = $userId";
        $query = mysqli_query($this->conn, $updateQuery);

        return $query;
    }
}

?>
