<?php
require_once "Personne.php";
require_once "Projet.php";
require_once "Equipe.php";

class  User extends Personne{

    public function afficheEquipe($membre) {
        $equipes = [];
    
        $stmt = $this->db->prepare("SELECT * FROM equipes INNER JOIN users ON equipes.id_equipe = users.id_equip  WHERE id_user=:membre");
        $stmt->bindParam(':membre', $membre, PDO::PARAM_INT);
        $stmt->execute();
    
        if ($stmt->rowCount() == 0) {
            echo "Il n'y a pas encore d'equipe.";
        } else {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $equipe = new Equipe(
                    $row['Name_equipe'],
                    $row['date_creation'],
                    $row['id_equipe'],
                    $row['Last_name']
                );
                $equipes[] = $equipe;
            }
        }   
        return $equipes;
    }

    public function afficheProjet($membre) {
        $projects = [];
    
        $stmt = $this->db->prepare("SELECT * FROM projets INNER JOIN equipes ON projets.equipe_id = equipes.id_equipe INNER JOIN users ON equipes.id_equipe = users.id_equip  WHERE id_user= :membre ");
        $stmt->bindParam(':membre', $membre, PDO::PARAM_INT);
        $stmt->execute();
    
    
        if ($stmt->rowCount() == 0) {
            echo "Il n'y a pas encore de projets.";
        } else {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $project = new Projet(
                    $row['nom_projet'],
                    $row['date_debut'],
                    $row['date_fin'],
                    $row['status_projet'],
                    $row['Last_name'],
                    $row['id_projets'],
                    $row['equipe_id']
                );
                $projects[] = $project;
            }
        }
    
        return $projects;
    }
    
}

?>