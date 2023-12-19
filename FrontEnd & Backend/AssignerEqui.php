<?php
include "connexion.php";
include "../src/ProjectAssignmentManager.php";

$projectAssignmentManager = new ProjectAssignmentManager($conn);

session_start();

if ($_SESSION['autoriser'] != "oui") {
    header("Location: index.php");
    exit();
}

if (isset($_POST["submit"])) {
    // Récupérer les valeurs du formulaire
    $selectedEquipe = $_POST["equipe"];
    $selectedProjet = $_POST["projet"];

    $success = $projectAssignmentManager->assignProjectToTeam($selectedEquipe, $selectedProjet);

    if ($success) {
        header("Location: Assignation.php");
        exit();
    }
}

$membre = $_SESSION['id'];
$teams = $projectAssignmentManager->getTeamsForScrumMaster($membre);
$projects = $projectAssignmentManager->getAllProjects();
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
                        <div class="d-flex justify-content-end px-3 py-1 "><a href="Assignation.php"
                                class="text-danger fs-5"><i class="bi bi-x-lg"></i></a></div>
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none px-2 d-md-flex align-items-center">
                                <img src="../Image/ajouter.jpg" alt="login form" class="img-fluid" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body text-black">

                                    <form method="post" action="">


                                        <h5 class="fw-semibold mb-3 mt-3 pb-3" style="letter-spacing: 1px;">Affecter une
                                            équipe à un projet</h5>
                                        <label for="cars" class="my-2 ">Sélectionnez Equipe :</label>
                                        <select class="form-select" aria-label="Default select example" name="equipe">
                                            <?php

                               $queryEquipe = mysqli_query($conn, "SELECT id_equipe, Name_equipe FROM equipes WHERE scrum_master_id=$membre ;");
                                while ($equipe = mysqli_fetch_assoc($queryEquipe)) {
                               echo "<option value='{$equipe['id_equipe']}'>{$equipe['Name_equipe']}</option>";
                             }
                             ?>

                                        </select>

                                        <label for="cars" class="my-2">Sélectionnez le projets :</label>
                                        <select class="form-select" aria-label="Default select example" name="projet">
                                            <?php
                            $queryProjet = mysqli_query($conn, "SELECT id_projets, nom_projet FROM projets  ");
                            while ($projet = mysqli_fetch_assoc($queryProjet)) {
                           echo "<option value='{$projet['id_projets']}'>{$projet['nom_projet']}</option>";
                          }
                           ?>
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
