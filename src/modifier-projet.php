<?php
class Project
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getProjectById($id)
    {
        $query = mysqli_query($this->conn, "SELECT * FROM projets WHERE id_projets= $id");
        return mysqli_fetch_array($query);
    }

    public function updateProject($id, $name, $dateStart, $dateEnd, $status)
    {
        $requete = "UPDATE projets SET nom_projet='$name', date_debut= '$dateStart', date_fin= '$dateEnd', status_projet= '$status' WHERE id_projets=$id";
        $query = mysqli_query($this->conn, $requete);
        return $query;
    }
}
?>
