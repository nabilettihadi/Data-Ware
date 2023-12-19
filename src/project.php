<?php

class Project {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getProjects($userId) {
        $projects = [];

        $req = mysqli_query($this->conn, "SELECT * FROM projets INNER JOIN equipes ON projets.equipe_id = equipes.id_equipe INNER JOIN users ON equipes.id_equipe = users.id_equip WHERE id_user=$userId");

        while ($row = mysqli_fetch_array($req)) {
            $projects[] = $row;
        }

        return $projects;
    }
}

?>
