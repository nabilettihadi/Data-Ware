<?php
class Membre
{
    private $message = "";
    private $user;
    private $membre;
    private $conn;

    public function __construct($connection)
    {
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
        $this->membre = $_SESSION['id'];
        $this->conn = $connection;

        $this->renderPage();
    }

    private function redirect($location)
    {
        header("Location: $location");
        exit();
    }

    private function renderPage()
    {
        $reqTeams = mysqli_query($this->conn, "SELECT * FROM equipes INNER JOIN users ON equipes.id_equipe = users.id_equip WHERE id_user=$this->membre");
        $reqProjects = mysqli_query($this->conn, "SELECT * FROM projets INNER JOIN equipes ON projets.equipe_id = equipes.id_equipe INNER JOIN users ON equipes.id_equipe = users.id_equip WHERE id_user=$this->membre");

        $this->renderHeader();
        $this->renderBody($reqTeams);
        $this->renderProjects($reqProjects);
    }

    public function renderHeader()
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
            <link rel="stylesheet" href="style.css" type="text/css">
        
            <title>Document</title>
        </head>

        <body>
            <header>
                <nav class="navbar navbar-expand-lg navbar-scroll  shadow-0 border-bottom border-dark">
                    <div class="container">
                        <img src="../Image/log.png" alt="logo" class="rounded-4" style="width: 80px; height: 60px;">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class=" text-light bi bi-list"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto d-flex gap-5">
                                <li class="nav-item text-center">
                                    <a class="nav-link" href="community.php">Community</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-center" href="DashboardUser.php">Mes équipes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-center" href="MesProjets.php">Mes projets</a>
                                </li>
        
                                <a href="deconnexion.php"
                                    class="btn bg-danger p-2 rounded-3 text-light text-decoration-none "><i
                                        class="bi bi-box-arrow-left"></i> Deconnexion</a>
                            </ul>
                        </div>
                    </div>
                </nav>
                <h5 class="mt-2 ms-2">Bienvenue <?php echo $this->user; ?> !</h5>
                <h1 class="d-flex justify-content-center mt-5 mb-5"> Mes équipes </h1>
            </header>
        <?php
    }

    public function renderBody($req)
    {
        ?>
        <div class="container mt-4">
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-primary mt-4 table-hover">
                            <thead>
                                <tr>
                                    <th class=" align-middle"> Nom d'équipe </th>
                                    <th class=" align-middle">Date de creation</th>
                                </tr>
                            </thead>
                            <?php
                            if (mysqli_num_rows($req) == 0) {
                                $this->message = "Il n'y a pas encore d'équipe.";
                            } else {
                                while ($row = mysqli_fetch_array($req)) {
                                    ?>
                                    <tbody class="table-light ">
                                        <tr>
                                            <td><?= $row['Name_equipe']; ?></td>
                                            <td><?php echo $row['date_creation']; ?></td>
                                        </tr>
                                    </tbody>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-center fs-5 fw-bolder text-danger"><?php echo $this->message; ?></p>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>
        <?php
    }

    public function renderProjects($req)
    {
        ?>
        <h1 class="d-flex justify-content-center mt-5 mb-5"> Mes Projets </h1>
        <div class="container mt-4">
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-primary mt-4 table-hover">
                            <thead>
                                <tr>
                                    <th class=" align-middle"> Nom du projet</th>
                                    <th class=" align-middle">Date début</th>
                                    <th class=" align-middle"> Date fin </th>
                                    <th class=" align-middle">Status</th>
                                </tr>
                            </thead>
                            <?php
                            if (mysqli_num_rows($req) == 0) {
                                $this->message = "Il n'y a pas encore de projets.";
                            } else {
                                while ($row = mysqli_fetch_array($req)) {
                                    ?>
                                    <tbody class="table-light ">
                                        <tr>
                                            <td><?= $row['nom_projet']; ?></td>
                                            <td><?php echo $row['date_debut']; ?></td>
                                            <td><?php echo $row['date_fin']; ?></td>
                                            <td><?php echo $row['status_projet']; ?></td>
                                        </tr>
                                    </tbody>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-center fs-5 fw-bolder text-danger"><?php echo $this->message; ?></p>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>
        <?php
    }
}
?>
