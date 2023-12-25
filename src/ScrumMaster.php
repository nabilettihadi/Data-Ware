<?php
require_once "Personne.php";
require_once "Equipe.php";
require_once "Projet.php";

class  ScrumMaster extends Personne{


    public function displayEquipe($membre) {
        $equipes = [];
    
        $stmt = $this->db->query("SELECT * FROM equipes LEFT JOIN users ON equipes.scrum_master_id = users.id_user WHERE scrum_master_id=$membre");
    
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

    public function deleteEquipeById($id,$membre) {
        $stmtUser = $this->db->prepare("UPDATE users SET id_equip = NULL WHERE id_equip=:id");
        $stmtUser->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtUser->execute();
        
        $stmtProjet = $this->db->prepare("UPDATE projets SET equipe_id = NULL WHERE equipe_id=:id");
        $stmtProjet->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtProjet->execute();

        $stmtEquipe = $this->db->prepare("DELETE FROM equipes WHERE id_equipe=:id AND scrum_master_id=:membre");
        $stmtEquipe->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtEquipe->bindParam(':membre', $membre, PDO::PARAM_STR);
        $stmtEquipe->execute();

    
        header("Location: DashboardScrum.php");
        exit();
    }
    
    public function getEquipeById($id) {
        $stmt = $this->db->prepare("SELECT * FROM equipes WHERE id_equipe= :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $equipe = new Equipe(
                $row['Name_equipe'],
                $row['date_creation'],
                $row['id_equipe'],
                $row['scrum_master_id']
            );
        }

        return $equipe;
    }
    public function updateEquipe($id, $nom, $dated) {
        $stmt = $this->db->prepare("UPDATE equipes SET Name_equipe=:nom, date_creation= :dated WHERE id_equipe=:id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':dated', $dated, PDO::PARAM_STR);
        $success = $stmt->execute();
    
        if ($success) {
            header("Location: DashboardScrum.php");
            exit();  
        } else {
            echo "Erreur lors de la mise à jour d'equipe.";
        }
    }
    public function createEquipe($nom, $dated,$membre) {
        $stmt = $this->db->prepare("INSERT INTO equipes (Name_equipe, date_creation, scrum_master_id) VALUES (?, ? ,?)");
        $stmt->bindParam(1, $nom, PDO::PARAM_STR);
        $stmt->bindParam(2, $dated, PDO::PARAM_STR);
        $stmt->bindParam(3, $membre, PDO::PARAM_INT);
    
        $valide = $stmt->execute();
    
        if ($valide) {
            header("Location: DashboardScrum.php");
            exit();  
        } else {
            echo "Erreur lors de la mise à jour d'equipe.";
        }
    }

    public function getMembresByEquipe($equipeId) {
        

            $query = "SELECT * FROM users WHERE id_equip = :equipeId AND role = 'user'";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':equipeId', $equipeId, PDO::PARAM_INT);
            $statement->execute();
            
            if ($statement->rowCount() == 0 || $statement === null) {
               echo "<h6 class='text-danger'> Il n'y a pas encore de membre.  </h6>";
                
            } else {
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $users[] = $row;
                    
                }
                return $users;
            
              }
            }

            public function deleteMember($membre_id) {
                $stmt = $this->db->prepare("UPDATE users SET id_equip = NULL WHERE id_user = :membre_id");
                $stmt->bindParam(':membre_id', $membre_id, PDO::PARAM_INT);
                $success = $stmt->execute();
            
                    header("Location: Gestionequi.php");
                    exit();  
                      
            }

            public function getMembres() {
                   $users = [];
                $query = "SELECT id_user , First_name , Last_name FROM users WHERE id_equip IS NULL AND role ='user';";
                $statement = $this->db->prepare($query);
                $statement->execute();
                
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                        $users[] = $row;
                        
                    }
                    return $users;
                
                  }

            public function addMember($id,$selectedMembre){
                $stmt = $this->db->prepare("UPDATE users SET id_equip  = :id WHERE id_user = :selectedMembre");
                $stmt->bindParam(':selectedMembre', $selectedMembre, PDO::PARAM_INT);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $success = $stmt->execute();
            
                    header("Location: Gestionequi.php");
                    exit();  
                      
                
            }

            public function displayProjEqui() {
                $projets = [];
            
                $stmt = $this->db->query("SELECT * FROM projets LEFT JOIN equipes ON projets.equipe_id = equipes.id_equipe ");
            
                if ($stmt->rowCount() == 0) {
                    echo "Il n'y a pas encore";
                } else {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $projet = new Projet(
                        $row['nom_projet'],
                        $row['date_debut'],
                        $row['date_fin'],
                        $row['status_projet'],
                        $row['scrum_master_id'],
                        $row['id_projets'],
                        $row['Name_equipe']
                        );
                        $projets[] = $projet;
                    }
                }   
                return $projets;
            }

            public function assignerEqui($equipe,$projet){
                $stmt = $this->db->prepare("UPDATE projets SET equipe_id = :equipe WHERE id_projets = :projet");
                $stmt->bindParam(':equipe', $equipe, PDO::PARAM_INT);
                $stmt->bindParam(':projet', $projet, PDO::PARAM_INT);
                $success = $stmt->execute();
            
                header("Location: Assignation.php");
                    exit();  
                      
                
            }

                  
                }

            
            


?>