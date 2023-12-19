<?php
class User
{
    private $conn;
    private $username;
    private $id;
    private $role;
    public $erreur_nom;
    public $erreur_prenom;
    public $erreur_email;
    public $erreur_mot_de_passe;

    public function __construct($conn, $username, $id, $role)
    {
        $this->conn = $conn;
        $this->username = $username;
        $this->id = $id;
        $this->role = $role;
        $this->conn = $conn;
        $this->erreur_nom = "";
        $this->erreur_prenom = "";
        $this->erreur_email = "";
        $this->erreur_mot_de_passe = "";
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function authorize($requiredRole)
    {
        if ($_SESSION['autoriser'] !== "oui" || $this->role !== $requiredRole) {
            header("Location: index.php");
            exit();
        }
    }

    public function authenticate($email, $password)
    {
        $select = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $query = mysqli_query($this->conn, $select);
        $row = mysqli_num_rows($query);
        $fetch = mysqli_fetch_array($query);

        if ($row == 1) {
            $this->initializeSession($fetch);
            $this->redirectDashboard($fetch['role']);
        } else {
            // You might want to handle the error differently, like setting an error message.
            echo "Authentication failed.";
        }
    }

    public function initializeSession($fetch)
    {
        $_SESSION['username'] = $fetch['last_name'];
        $_SESSION['id'] = $fetch['id_user'];
        $_SESSION['role'] = $fetch['role'];
        $_SESSION['autoriser'] = "oui";
    }

    public function redirectDashboard($role)
    {
        if ($role == "user") {
            header("Location: DashboardUser.php");
        } elseif ($role == "scrum_master") {
            header("Location: DashboardScrum.php");
        } else {
            header("Location: DashboardM.php");
        }
        exit();
    }

    public function registerUser($nom, $prenom, $email, $mot_de_passe)
    {
        $this->validerFormulaire($nom, $prenom, $email, $mot_de_passe);

        if (empty($this->erreur_nom) && empty($this->erreur_prenom) && empty($this->erreur_email) && empty($this->erreur_mot_de_passe)) {
            $this->insererUtilisateur($nom, $prenom, $email, $mot_de_passe);
            header("Location: validation.php");
            exit();
        }
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
