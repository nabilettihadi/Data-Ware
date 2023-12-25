<?php
require_once "Personne.php";
require_once "Projet.php";

class  ProductOwner extends Personne{
    
    public function displayProjet() {
        $projects = [];
    
        $stmt = $this->db->query("SELECT * FROM projets LEFT JOIN users ON projets.scrum_master_id = users.id_user");
    
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
    
    public function deleteProjetById($id) {
        
            $stmt = $this->db->prepare("DELETE FROM projets WHERE id_projets = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

        
            header("Location: DashboardM.php");
            exit();
        }

        public function getProjetById($id) {
            $stmt = $this->db->prepare("SELECT * FROM projets WHERE id_projets = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $project = new Projet(
                    $row['nom_projet'],
                    $row['date_debut'],
                    $row['date_fin'],
                    $row['status_projet'],
                    $row['scrum_master_id'],
                    $row['id_projets'],
                    $row['equipe_id']
       
                );
            }
    
            return $project;
        }
    
        public function updateProjet($id, $nom, $dated, $datef, $status) {
            $stmt = $this->db->prepare("UPDATE projets SET nom_projet = :nom, date_debut = :dated, date_fin = :datef, status_projet = :status WHERE id_projets = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':dated', $dated, PDO::PARAM_STR);
            $stmt->bindParam(':datef', $datef, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        
            $success = $stmt->execute();
        
            if ($success) {
                header("Location: DashboardM.php");
                exit();  
            } else {
                echo "Erreur lors de la mise à jour du projet.";
            }
        }
        

        public function createProjet($nom, $dated, $datef, $status) {
            $stmt = $this->db->prepare("INSERT INTO projets (nom_projet, date_debut, date_fin, status_projet) VALUES (?, ?, ?, ?)");
            $stmt->bindParam(1, $nom, PDO::PARAM_STR);
            $stmt->bindParam(2, $dated, PDO::PARAM_STR);
            $stmt->bindParam(3, $datef, PDO::PARAM_STR);
            $stmt->bindParam(4, $status, PDO::PARAM_STR);
    
            $valide = $stmt->execute();
        
            if ($valide) {
                header("Location: DashboardM.php");
                exit();  
            } else {
                echo "Erreur lors de la mise à jour du projet.";
            }
        }
        public function getAllProjects() {
            $projects = [];
                $stmt = $this->db->query("SELECT * FROM projets");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $project = new Projet(
                        $row['nom_projet'],
                        $row['date_debut'],
                        $row['date_fin'],
                        $row['status_projet'],
                        $row['scrum_master_id'],
                        $row['id_projets'],
                        $row['equipe_id']
                    );
                    $projects[] = $project;
                }
                return $projects;
            }

        public function getAllScrumMaster() {
                $Scrums = [];
                $stmt = $this->db->query("SELECT id_user, Last_name FROM users WHERE role = 'scrum_master'");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $Scrums[] = $row;
                }
                return $Scrums;
            }
            
        public function updateScrumMaster($projectId, $scrumMasterId) {
                
                    $query = "UPDATE projets SET scrum_master_id = :scrumMasterId WHERE id_projets = :projectId";
                    $statement = $this->db->prepare($query);
                    $statement->bindParam(':scrumMasterId', $scrumMasterId, PDO::PARAM_INT);
                    $statement->bindParam(':projectId', $projectId, PDO::PARAM_INT);
                    $statement->execute();
    
                    header("Location: DashboardM.php");
            }
            
         public function getUsersWithRole() {
            $users=[];
                $stmt = $this->db->prepare("SELECT * FROM users WHERE role IN ('scrum_master', 'user')");
                $stmt->execute();
        
                if ($stmt->rowCount() == 0) {
                    echo "Il n'y a pas encore d'utilisateur.";
                } else {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $users[] = $row;
                        
                    }
                    return $users;
                }
            }
         public function getUserById($id) {
                $stmt = $this->db->prepare("SELECT * FROM users WHERE id_user = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
        
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
         public function updateRole($id, $role) {
                $stmt = $this->db->prepare("  UPDATE users SET role =:role WHERE id_user=:id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':role', $role, PDO::PARAM_STR);
              
                $stmt->execute();
            
                
                    header("Location: MembreP.php");
                    exit();  
            }
        

        
           
           
        }
        
       

?>