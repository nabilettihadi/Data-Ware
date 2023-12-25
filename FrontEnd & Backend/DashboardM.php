<?php
session_start();
if ($_SESSION['autoriser'] != "oui") {
    header("Location: index.php");
    exit();
}
require_once "../src/ProductOwner.php";
$user = $_SESSION['username'];

$affichage = new ProductOwner();
$projects = $affichage->displayProjet();
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
                            <a class="nav-link" href="DashboardM.php">Projets</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link" href="MembreP.php">Membres</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link" href="assigner.php">Assignation</a>
                        </li>

                        <a href="deconnexion.php"
                            class="btn bg-danger p-2 rounded-3 text-light text-decoration-none "><i
                                class="bi bi-box-arrow-left"></i> Deconnexion</a>
                    </ul>
                </div>
            </div>
        </nav>
        <h5 class="mt-2 ms-2">Bienvenue
            <?php echo $user; ?> !
        </h5>
        <h1 class="d-flex justify-content-center mt-5"> Gestion du Projets </h1>

        <div class="container mt-4">
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-wrap justify-content-start gap-2 mt-4">
                        <a href="ajouter.php"
                            class="col-md-auto col-sm-12 bg-primary p-2 rounded-3 text-light text-decoration-none btn mb-2">
                            <i class="bi bi-bookmark-plus-fill"></i> Créer un nouveau projet</a>
                        <a href="assigner.php"
                            class="col-md-auto col-sm-12 bg-primary p-2 rounded-3 text-light text-decoration-none btn mb-2">
                            <i class="bi bi-bookmark-plus-fill"></i> Affecter un Scrum Master à un Projet </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-primary table-hover">
                            <thead>
                                <tr>
                                    <th class="align-middle">Nom du projet</th>
                                    <th class="align-middle">Date début</th>
                                    <th class="align-middle">Date fin</th>
                                    <th class="align-middle">Status</th>
                                    <th class="align-middle">Scrum Master</th>
                                    <th class="align-middle">Modifier</th>
                                    <th class="align-middle">Supprimer</th>
                                </tr>
                            </thead>
                            <?php
                            foreach ($projects as $projet) {
                                ?>
                                <tbody class="table-light">
                                    <tr>
                                        <td>
                                            <?php echo $projet->getNomProjet(); ?>
                                        </td>
                                        <td>
                                            <?php echo $projet->getDateDebut(); ?>
                                        </td>
                                        <td>
                                            <?php echo $projet->getDateFin(); ?>
                                        </td>
                                        <td>
                                            <?php echo $projet->getStatusProjet(); ?>
                                        </td>
                                        <td>
                                            <?php echo $projet->getScrumMaster(); ?>
                                        </td>
                                        <td><a href="modifier.php?id=<?= $projet->getIdProjets() ?>" class="ms-4"><i
                                                    class="bi bi-pencil"></i></a></td>
                                        <td><a href="supprimer.php?id=<?= $projet->getIdProjets() ?>"
                                                class="text-danger ms-4"><i class="bi bi-trash3-fill"></i></a></td>
                                    </tr>
                                </tbody>
                                <?php
                            }

                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- <p class="text-center fs-5 fw-bolder text-danger"><?php echo $message; ?></p> -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>