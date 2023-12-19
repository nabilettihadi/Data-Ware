<?php
class ProjectManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function deleteProject($id)
    {
        $query = mysqli_query($this->conn, "DELETE FROM projets WHERE id_projets=$id");
        return $query;
    }
}
?>
