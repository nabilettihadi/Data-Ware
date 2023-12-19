<?php

class ProjectCreation
{
    private $conn;

    public function __construct($connection)
    {
        session_start();

        if ($_SESSION['autoriser'] != "oui") {
            $this->redirect("index.php");
            exit();
        }

        $this->conn = $connection;

        if (isset($_POST["submit"])) {
            $this->createProject();
        }

        $this->renderPage();
    }

    private function redirect($location)
    {
        header("Location: $location");
        exit();
    }

    private function createProject()
    {
        $nom = $_POST["name"];
        $dated = $_POST["dated"];
        $datef = $_POST["datef"];
        $status = $_POST["statuss"];

        $requete = "INSERT INTO projets (nom_projet, date_debut, date_fin, status_projet) VALUES ('$nom', '$dated', '$datef', '$status')";
        $query = mysqli_query($this->conn, $requete);
        $this->redirect("DashboardM.php");
    }

    private function renderPage()
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
            <link rel="stylesheet" href="style.css">
            <title>Document</title>
        </head>

        <body>
            <section class="vh-100" style="background-color: #6BA7F0;">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-xl-10">
                            <div class="card" style="border-radius: 1rem;">
                                <div class="d-flex justify-content-end px-3 py-1 "><a href="DashboardM.php"
                                        class="text-danger fs-5"><i class="bi bi-x-lg"></i></a></div>
                                <div class="row g-0">
                                    <div class="col-md-6 col-lg-5 d-none px-2 d-md-flex align-items-center">
                                        <img src="../Image/ajouter.jpg" alt="login form" class="img-fluid" />
                                    </div>
                                    <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                        <div class="card-body text-black">

                                            <form method="post" action="">


                                                <h5 class="fw-semibold mb-3 mt-3 pb-3" style="letter-spacing: 1px;">Créer un
                                                    nouveau projet</h5>

                                                <div class="form-floating mb-3">
                                                    <input type="text" name="name" class="form-control" id="floatingInput"
                                                        value="" placeholder="name" required>
                                                    <label class="text-secondary" for="floatingInput">Nom du projet</label>
                                                    <span class="ms-2 text-danger "></span>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="dated" class="form-control" id="floatingInput"
                                                        value="" placeholder="last" required>
                                                    <label class="text-secondary" for="floatingInput">Date début</label>
                                                    <span class="ms-2 text-danger "></span>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="datef" class="form-control" id="floatingInput"
                                                        value="" placeholder="last" required>
                                                    <label class="text-secondary" for="floatingInput">Date fin</label>
                                                    <span class="ms-2 text-danger "></span>
                                                </div>
                                                <label for="cars" class="mb-1">Status:</label>
                                                <select class="form-select" aria-label="Default select example" name="statuss">
                                                    <option selected>en cours</option>
                                                    <option value="finaliser">finaliser</option>
                                                </select>


                                                <div class="pt-1 mb-3 d-flex mt-2 justify-content-end">
                                                    <button class="btn btn-primary btn-lg btn-block" type="submit"
                                                        name="submit">Valider</button>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>
        <?php
    }
}

?>
