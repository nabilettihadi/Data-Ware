<?php
include "connexion.php";
include "../src/user.php";
include "../src/Membre.php";
session_start();
$user= $_SESSION['username'];
$membre= $_SESSION['id'];
$message="";

$membreObj = new Membre($conn, $user, $membre);
$membreObj->verifierAutorisation();
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
                        <li class="nav-item">
                            <a class="nav-link text-center" href="community.php">Community</a>
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
    </header>
    <?php
    $membreObj->afficherBienvenue();
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
                                $membreObj->afficherProjets($membre);
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $membreObj->afficherMessageErreur($message);
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
