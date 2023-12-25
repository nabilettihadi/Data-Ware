<?php
require_once "conn.php";
class Personne {
    protected $id_user;
    protected $nom;
    protected $prenom;
    protected $email ;
    protected $mot_de_passe;
    protected $role;
    protected $db;
    public $error;
    public $erreur_nom;
    public $erreur_prenom;
    public $erreur_email;
    public $erreur_mot_de_passe;
    public $errore;
    

    public function __construct(){
        $this->errore="";
        $this->error="";
        $this->erreur_nom = $this->erreur_prenom = $this->erreur_email =  $this->erreur_mot_de_passe = "";
        $this->db = Database::getInstance()->getConnection();
    }
    public function getNom() {
        return $this->nom;
    }
    public function getIdUser() {
        return $this->id_user;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getrole() {
        return $this->role;
    }

    
    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setRole($role) {
        $this->role = $role;
    }
    

   
    public function authentifierUtilisateur($email, $mot_de_passe) {
        
        
        
        
        $stmt =  $this->db->prepare("SELECT * FROM users WHERE email = :email AND password = :pass");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $mot_de_passe);
        $stmt->execute();
        

        $row = $stmt->rowCount();
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
        

        if ($row == 1) {
            $_SESSION['username'] = $fetch['Last_name'];
            $_SESSION['id'] =  $fetch['id_user'];
            $_SESSION['role'] = $fetch['role'];
            $_SESSION['autoriser'] = "oui";
          
            if($fetch["role"]== "user"){
                header("Location: DashboardUser.php");
              }
              elseif($fetch["role"]== "scrum_master"){
                header("Location: DashboardScrum.php");
              }
              else
               header("Location: DashboardM.php");
          
            
           
        } else {
            $this->error="L’adresse e-mail ou le mot de passe que vous avez saisi(e) n’est pas associé(e) à un compte. ";
        }
    }
    private function validate($nom, $prenom, $email, $mot_de_passe) {
        $pattern_nom_prenom = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]{3,}$/u';
        $pattern_email = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $pattern_mot_de_passe =  '/^.{8,}$/';

        // Valider le nom
        if (!preg_match($pattern_nom_prenom, $nom)) {
            $this->erreur_nom = "Veuillez entrer un nom valide (au moins 3 caractères)";
        }

        // Valider le prénom
        if (!preg_match($pattern_nom_prenom, $prenom)) {
            $this->erreur_prenom = "Veuillez entrer un prénom valide (au moins 3 caractères)";
        }

        // Valider l'email
        if (!preg_match($pattern_email, $email)) {
            $this->erreur_email = "Veuillez entrer une adresse e-mail valide.";
        }
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $this->erreur_email = "Email déjà utilisé";
        }

        // Valider le mot de passe
        if (!preg_match($pattern_mot_de_passe, $mot_de_passe)) {
            $this->erreur_mot_de_passe = "Veuillez entrer un mot de passe valide (au moins 8 caractères)";
        }
    }

    public function processRegistration($nom, $prenom, $email, $mot_de_passe) {
        $this->validate($nom, $prenom, $email, $mot_de_passe);

        // Si aucune erreur, rediriger vers la page souhaitée
        if (empty($this->erreur_nom) && empty($this->erreur_prenom) && empty($this->erreur_email) && empty($this->erreur_mot_de_passe)) {
            // Using prepared statements to prevent SQL injection
            $stmt = $this->db->prepare("INSERT INTO users (last_name, first_name, email, password) VALUES (:nom, :prenom, :email, :mot_de_passe)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mot_de_passe', $mot_de_passe);
            $stmt->execute();

            header("Location: validation.php");
        }
    }

    public function deconnexion(){
        session_start();
        session_destroy();
        header("Location: index.php");
    }

  
}



?>