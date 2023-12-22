<?php

class Membre {
    private $conn;
    private $user;
    private $membre;
    private $message;

    public function __construct($conn, $user, $membre) {
        $this->conn = $conn;
        $this->user = $user;
        $this->membre = $membre;
        $this->message = "";
    }

    public function verifierAutorisation() {
        if ($_SESSION['autoriser'] != "oui") {
            header("Location: index.php");
            exit();
        }

        if ($_SESSION['role'] != "user") {
            header("Location: community.php");
            exit();
        }
    }

    public function afficherBienvenue() {
        echo '<h5 class="mt-2 ms-2">Bienvenue ' . $this->user . ' !</h5>';
    }

    public function afficherMessageErreur($message) {
        echo '<p class="text-center fs-5 fw-bolder text-danger">' . $message . '</p>';
    }

    public function afficherEquipes($membre) {
        $req = mysqli_query($this->conn,"SELECT * FROM equipes INNER JOIN users ON equipes.id_equipe = users.id_equip  WHERE id_user=$membre ");
                                 if(mysqli_num_rows($req) == 0){
                                 $this->message="Il n'y a pas encore d'équipe.";
              
                                  } else{
                                      while($row=mysqli_fetch_array($req)){
                                          ?>
                            <tbody class="table-light ">
                                <tr>
                                    <td><?= $row['Name_equipe'];?></td>
                                    <td><?php echo $row['date_creation'];?></td>
                                </tr>
                            </tbody>
                            <?php
                                        }
                                   }
    }

    public function afficherProjets($membre) {
        $req = mysqli_query($this->conn,"SELECT * FROM projets INNER JOIN equipes ON projets.equipe_id = equipes.id_equipe INNER JOIN users ON equipes.id_equipe = users.id_equip  WHERE id_user=$membre ");
             if(mysqli_num_rows($req) == 0){
              $this->message="Il n'y a pas encore de projets.";
              
             } else{
              while($row=mysqli_fetch_array($req)){
                ?>
                            <tbody class="table-light ">
                                <tr>
                                    <td><?= $row['nom_projet'];?></td>
                                    <td><?php echo $row['date_debut'];?></td>
                                    <td><?php echo $row['date_fin'];?></td>
                                    <td><?php echo $row['status_projet'];?></td>
                                </tr>
                            </tbody>

                            <?php
              }
             }
    }
}

?>
