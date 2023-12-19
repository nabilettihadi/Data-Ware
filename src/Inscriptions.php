<?php
// inscription

class Inscription
{
    private $conn;
    public $erreur_nom;
    public $erreur_prenom;
    public $erreur_email;
    public $erreur_mot_de_passe;
    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->erreur_nom = "";
        $this->erreur_prenom = "";
        $this->erreur_email = "";
        $this->erreur_mot_de_passe = "";
    }

    public function validerFormulaire($nom, $prenom, $email, $mot_de_passe)
    {
        $this->validerNom($nom);
        $this->validerPrenom($prenom);
        $this->validerEmail($email);
        $this->validerMotDePasse($mot_de_passe);

        if (empty($this->erreur_nom) && empty($this->erreur_prenom) && empty($this->erreur_email) && empty($this->erreur_mot_de_passe)) {
            $this->insererUtilisateur($nom, $prenom, $email, $mot_de_passe);
            header("Location: validation.php");
            exit();
        }
    }

    private function validerNom($nom)
    {
        $pattern_nom_prenom = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]{3,}$/u';

        if (!preg_match($pattern_nom_prenom, $nom)) {
            $this->erreur_nom = "Veuillez entrer un nom valide (au moins 3 caractères)";
        }
    }

    private function validerPrenom($prenom)
    {
        $pattern_nom_prenom = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]{3,}$/u';

        if (!preg_match($pattern_nom_prenom, $prenom)) {
            $this->erreur_prenom = "Veuillez entrer un prénom valide (au moins 3 caractères)";
        }
    }
    private function validerEmail($email)
    {
        $pattern_email = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        if (!preg_match($pattern_email, $email)) {
            $this->erreur_email = "Veuillez entrer une adresse e-mail valide.";
        }

        $user = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($this->conn, $user);

        if (mysqli_num_rows($result) > 0) {
            $this->erreur_email = "Email déjà utilisé";
        }
    }

    private function validerMotDePasse($mot_de_passe)
    {
        $pattern_mot_de_passe = '/^.{8,}$/';

        if (!preg_match($pattern_mot_de_passe, $mot_de_passe)) {
            $this->erreur_mot_de_passe = "Veuillez entrer un mot de passe valide (au moins 8 caractères)";
        }
    }

    private function insererUtilisateur($nom, $prenom, $email, $mot_de_passe)
    {
        $requete = "INSERT INTO users (last_name, first_name, email, password) VALUES ('$nom', '$prenom', '$email', '$mot_de_passe')";
        $query = mysqli_query($this->conn, $requete);
    }
}
?>