<?php
// ScrumMaster.php

class ScrumMaster
{
    private $conn;
    private $username;
    private $id;

    public function __construct($conn, $username, $id)
    {
        $this->conn = $conn;
        $this->username = $username;
        $this->id = $id;
    }

    public function verifierAutorisation()
    {

        if ($_SESSION['autoriser'] != "oui") {
            header("Location: index.php");
            exit();
        }

        if ($_SESSION['role'] != "scrum_master") {
            header("Location: community.php");
            exit();
        }
    }

    public function afficherBienvenue()
    {
        echo '<h5 class="mt-2 ms-2">Bienvenue ' . $this->username . ' !</h5>';
    }

    public function afficherMessageErreur($message)
    {
        echo '<p class="text-center fs-5 fw-bolder text-danger">' . $message . '</p>';
    }
    
    public function afficherGestionEquipes($membre)
    {
             $req = mysqli_query($this->conn,"SELECT * FROM equipes LEFT JOIN users ON equipes.scrum_master_id = users.id_user WHERE scrum_master_id=$membre");
             if(mysqli_num_rows($req) == 0){
              $message="Il n'y a pas encore d'équipe.";
              
             } else{
              while($row=mysqli_fetch_array($req)){
                ?>
                            <tbody class="table-light ">
                                <tr>
                                    <td><?= $row['Name_equipe'];?></td>
                                    <td><?php echo $row['date_creation'];?></td>
                                    <td><?php echo $row['Last_name'];?></td>
                                    <td><a href="modifierequi.php?id=<?=$row['id_equipe']?>" class="ms-4"><i
                                                class="bi bi-pencil"></i></a></th>
                                    <td><a href="supprimerequi.php?id=<?=$row['id_equipe']?>"
                                            class="text-danger ms-4"><i class="bi bi-trash3-fill"></i></a></th>

                                </tr>
                            </tbody>

                            <?php
              }
             }
    }

    public function afficherGestionMembre($membre)
    {
        $resultat=mysqli_query($this->conn,"SELECT * FROM equipes WHERE scrum_master_id=$membre ");
        if(mysqli_num_rows($resultat) == 0){
          $msg="Il n'y a pas encore d'équipe.";
          
         } else{
        while($row=mysqli_fetch_assoc($resultat)){
          $equipe_id = $row['id_equipe'];
          $equipe_nom = $row['Name_equipe'];
          echo  "<h3 class='mt-4 text-primary'> Les membres d'équipe $equipe_nom : <a class='bg-primary rounded-3 text-light text-decoration-none btn' href='Ajouter_membre.php?equipe_id=$equipe_id'>Ajouter un membre</a> </h3>";

          $membres_result = mysqli_query($this->conn, "SELECT * FROM users WHERE id_equip = $equipe_id AND role = 'user' ");
          if(mysqli_num_rows($membres_result) == 0){
            echo "<h6 class='text-danger'> Il n'y a pas encore de membre. </h6>";
            
           } else{
          echo "<ul class='list-unstyled mt-4'>";
          while ($membre_row = mysqli_fetch_assoc($membres_result)) {
              $membre_prenom = $membre_row['First_name'];
              $membre_nom = $membre_row['Last_name'];
              $membre_id = $membre_row['id_user'];
  
              // Afficher chaque membre avec un bouton pour le supprimer
              echo "<div class='d-flex justify-content-between w-25 mb-3 mt-3 flex-wrap'><li class='fs-5'>$membre_prenom $membre_nom </li>
                <a class='bg-danger rounded-3 text-light text-decoration-none btn ' href='supprimer_membre.php?membre_id=$membre_id'>Supprimer</a></div>";
           }      
          }
        } 


      }
    }
    public function assignationEquipesPage($membre){
             $req = mysqli_query($this->conn,"SELECT * FROM projets LEFT JOIN equipes ON projets.equipe_id = equipes.id_equipe ");
             if(mysqli_num_rows($req) == 0){
              $message="Il n'y a pas de projet.";
              
             } else{
              while($row=mysqli_fetch_array($req)){
                ?>
                        <tbody class="table-light ">
                            <tr>
                                <td><?= $row['nom_projet'];?></td>
                                <td><?php echo $row['Name_equipe'];?></td>

                            </tr>
                        </tbody>

                        <?php
              }
             }
    }
    public function assignationProjets($equipe,$projet){
        $requete = "UPDATE projets SET equipe_id = '$equipe' WHERE id_projets = '$projet'";
        $query = mysqli_query($this->conn, $requete);
        header("Location: Assignation.php");
    }

    public function assignationEquipes($membre){
        echo '<form method="post" action="">


        <h5 class="fw-semibold mb-3 mt-3 pb-3" style="letter-spacing: 1px;">Affecter une
            équipe à un projet</h5>';
        echo '<label for="cars" class="my-2 ">Sélectionnez Equipe :</label>
                <select class="form-select" aria-label="Default select example" name="equipe">';
                    

        $queryEquipe = mysqli_query($this->conn, "SELECT id_equipe, Name_equipe FROM equipes WHERE scrum_master_id=$membre ;");
        while ($equipe = mysqli_fetch_assoc($queryEquipe)) {
        echo "<option value='{$equipe['id_equipe']}'>{$equipe['Name_equipe']}</option>";
        }
        

        echo '</select>

        <label for="cars" class="my-2">Sélectionnez le projets :</label>
        <select class="form-select" aria-label="Default select example" name="projet">';
            
        $queryProjet = mysqli_query($this->conn, "SELECT id_projets, nom_projet FROM projets  ");
        while ($projet = mysqli_fetch_assoc($queryProjet)) {
        echo "<option value='{$projet['id_projets']}'>{$projet['nom_projet']}</option>";
        }
        
        echo '</select>
        <div class="pt-1 mb-3 d-flex mt-2 justify-content-end">
            <button class="btn btn-primary btn-lg btn-block" type="submit"
                name="submit">Valider</button>
        </div>';
        echo '</form>';
    }
    public function ajouterMembre($membre){

        $queryMembre = mysqli_query($this->conn, "SELECT id_user , First_name , Last_name FROM users WHERE id_equip IS NULL AND role ='user';");
        while ($membre = mysqli_fetch_assoc($queryMembre)) {
            echo "<option value='{$membre['id_user']}'>{$membre['First_name']} {$membre['Last_name']}</option>";
        }
    }

    public function ajouterMembreQer($id,$membre){
        $requete = "UPDATE users SET id_equip  = '$id' WHERE id_user = '$membre'";
        $query = mysqli_query($this->conn, $requete);
        header("Location: Gestionequi.php");
    }
    public function supprimerMembre($membre_id){
        $membre_id = $_GET['membre_id'];
        $req=mysqli_query($this->conn, "UPDATE users SET id_equip = NULL WHERE id_user = $membre_id;");
        header("Location: Gestionequi.php");


    }
    public function ajouterEquipe($nom,$dated,$membre){
        $nom = $_POST["name"];
        $dated = $_POST["dated"];

        $requete = "INSERT INTO equipes (Name_equipe, date_creation, scrum_master_id) VALUES ('$nom', '$dated', '$membre')";
        $query = mysqli_query($this->conn, $requete);
        header("Location: DashboardScrum.php");
    }

    public function supprimerEquipe($id,$membre){
        $membre= $_SESSION['id'];
        $id=$_GET['id'];
        $requry=mysqli_query($this->conn, "UPDATE users SET id_equip = NULL WHERE id_equip=$id");
        $requery=mysqli_query($this->conn, "UPDATE projets SET equipe_id = NULL WHERE equipe_id=$id");
        $req=mysqli_query($this->conn, "DELETE FROM equipes WHERE id_equipe=$id AND scrum_master_id=$membre");
        header("Location: DashboardScrum.php");

    }
    public function modifierEquipe($nom,$dated,$id){
        $nom = $_POST["name"];
        $dated = $_POST["dated"];
        $requete = "UPDATE equipes SET Name_equipe='$nom', date_creation= '$dated' WHERE id_equipe=$id";
        $query = mysqli_query($this->conn, $requete);
        header("Location: DashboardScrum.php");
        return $query;
    }
    public function selectModifierEquipe($id){
        $req= mysqli_query($this->conn, "SELECT * FROM equipes WHERE id_equipe= $id");
        return $row=mysqli_fetch_array($req);
    }
}
                                              
?>