<?php
class UserManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function updateUserRole($id, $role)
    {
        $requete = "UPDATE users SET role ='$role' WHERE id_user=$id";
        $query = mysqli_query($this->conn, $requete);
        return $query;
    }
}
?>
