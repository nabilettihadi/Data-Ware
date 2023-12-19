<?php

class ProjectAssignmentManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function assignProjectToTeam($selectedEquipe, $selectedProjet)
    {
        $requete = "UPDATE projets SET equipe_id = '$selectedEquipe' WHERE id_projets = '$selectedProjet'";
        $query = mysqli_query($this->conn, $requete);

        return $query;
    }

    public function getTeamsForScrumMaster($membre)
    {
        $teams = [];

        $queryEquipe = mysqli_query($this->conn, "SELECT id_equipe, Name_equipe FROM equipes WHERE scrum_master_id=$membre ;");
        while ($equipe = mysqli_fetch_assoc($queryEquipe)) {
            $teams[] = [
                'id_equipe' => $equipe['id_equipe'],
                'Name_equipe' => $equipe['Name_equipe']
            ];
        }

        return $teams;
    }

    public function getAllProjects()
    {
        $projects = [];

        $queryProjet = mysqli_query($this->conn, "SELECT id_projets, nom_projet FROM projets");
        while ($projet = mysqli_fetch_assoc($queryProjet)) {
            $projects[] = [
                'id_projets' => $projet['id_projets'],
                'nom_projet' => $projet['nom_projet']
            ];
        }

        return $projects;
    }
}

?>