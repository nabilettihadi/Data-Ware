<?php
class Membre
{
    private $message;
    private $user;
    private $userId;
    private $membre;
    private $conn;

    public function __construct($connection) {
        session_start();

        if ($_SESSION['autoriser'] != "oui") {
            $this->redirect("index.php");
            exit();
        }

        if ($_SESSION['role'] != "user") {
            $this->redirect("community.php");
            exit();
        }

        $this->user = $_SESSION['username'];
        $this->userId = $_SESSION['id'];
        $this->membre = $_SESSION['id'];
        $this->conn = $connection;
        $this->message = "";

        // Initialize user ID before rendering the page
        $this->initializeUserId();

        $this->renderPage();
    }

    private function initializeUserId()
    {
        // Get the user ID from the session and set it to a property
        $this->userId = $_SESSION['id'];
    }

    public function getUsername()
    {
        return $this->user;
    }
    public function getMessage()
    {
        return $this->message;
    }

    public function getProjects() {
        $projects = [];
    
        $req = mysqli_query($this->conn, "SELECT * FROM projets INNER JOIN equipes ON projets.equipe_id = equipes.id_equipe INNER JOIN users ON equipes.id_equipe = users.id_equip WHERE id_user=$this->userId");
    
        while ($row = mysqli_fetch_array($req)) {
            $projects[] = $row;
        }
    
        return $projects;
    }
    

    private function redirect($location)
    {
        header("Location: $location");
        exit();
    }

    private function renderPage()
    {
        $req = mysqli_query($this->conn, "SELECT * FROM equipes INNER JOIN users ON equipes.id_equipe = users.id_equip WHERE id_user=$this->membre");

        $this->renderHeader();
        $this->renderBody($req);
    }

    private function renderHeader()
    {
        $this->message;
        $this->user;
    }

    private function renderBody($req)
    {
        
    }
    
}
?>
