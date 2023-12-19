<?php
include "connexion.php";
include "../src/auth.php";
include "../src/statistic.php";

AuthManager::authenticateUser();

$statisticsManager = new StatisticsManager($conn);

$questionsPerProjectResult = $statisticsManager->getQuestionsPerProject();

$projectsFewestResponsesResult = $statisticsManager->getProjectsWithFewestResponses();
$projectsMostQuestionsResult = $statisticsManager->getProjectsMostQuestions();
$userMostResponsesResult = $statisticsManager->getUserWithMostResponses();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
 
    body {
        background-color: #f8f9fa;
    }

    .container1 {

        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
    }

    .list-group-item {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
    }

    .card {
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-top: 20px;
    }

    .card-body {
        color: #495057;
    }

    .alert {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    /* Badge Styles */
    .badge-primary {
        background-color: #007bff;
        /* Blue */
    }

    .badge-warning {
        background-color: #ffc107;
        /* Yellow */
    }

    .badge-danger {
        background-color: #dc3545;
        /* Red */
    }
    </style>
    <title>Statistiques</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-scroll  shadow-0 border-bottom border-dark">
        <div class="container">
            <img src="../Image/log.png" alt="logo" class="rounded-4" style="width: 80px; height: 60px;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class=" text-light bi bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto d-flex gap-5">
                    <li class="nav-item text-center">
                    <li class="nav-item text-center">
                        <a class="nav-link" href="community.php">Community</a>
                    </li>
                    <a class="nav-link text-center " href="DashboardM.php">Projets</a>
                    </li>
                    <li class="nav-item text-center">
                        <a class="nav-link" href="MembreP.php">Membres</a>
                    </li>
                    <li class="nav-item text-center">
                        <a class="nav-link" href="assigner.php">Assignation</a>
                    </li>
                    <li class="nav-item text-center">
                        <a class="nav-link" href="pr.php">Statistique</a>
                    </li>

                    <a href="deconnexion.php" class="btn bg-danger p-2 rounded-3 text-light text-decoration-none "><i
                            class="bi bi-box-arrow-left"></i> Deconnexion</a>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Statistiques sur le nombre de questions par projet -->
    <?php
    

    $query = "SELECT projets.nom_projet, COUNT(questions.id_question) as total_questions
              FROM projets
              LEFT JOIN questions ON projets.id_projets = questions.projet_id
              GROUP BY projets.id_projets";

    $result = mysqli_query($conn, $query);
    ?>
    <div class="container">

        <div class="container1 mt-5">
            <h2 class="mb-4">Nombre de questions par projet :</h2>

            <?php if ($result) : ?>
            <ul class="list-group">
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= $row['nom_projet'] ?>
                    <span class="badge bg-primary rounded-pill"><?= $row['total_questions'] ?> questions</span>
                </li>
                <?php endwhile; ?>
            </ul>
            <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Erreur lors de la récupération des données.
            </div>
            <?php endif; ?>
        </div>

        <!-- Statistiques sur le projet avec le moins de réponses -->
        <?php
    $query = "SELECT projets.nom_projet, COUNT(questions.id_question) as total_questions, 
              COALESCE(COUNT(DISTINCT reponses.id_reponse), 0) as total_reponses
              FROM projets
              LEFT JOIN questions ON projets.id_projets = questions.projet_id
              LEFT JOIN reponses ON questions.id_question = reponses.question_id
              GROUP BY projets.id_projets
              ORDER BY total_reponses ASC
              LIMIT 3";

    $result = mysqli_query($conn, $query);
    ?>

        <div class="container1 mt-5">
            <h2 class="mb-4">Projet avec le moins de réponses :</h2>

            <?php if ($result && mysqli_num_rows($result) > 0) : ?>
            <?php $row = mysqli_fetch_assoc($result); ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['nom_projet'] ?></h5>
                    <p class="card-text"><?= $row['total_reponses'] ?> réponses pour <?= $row['total_questions'] ?>
                        questions</p>
                </div>
            </div>
            <?php else : ?>
            <div class="alert alert-warning" role="alert">
                Aucun projet trouvé.
            </div>
            <?php endif; ?>
        </div>

        <!-- Statistiques sur le projet avec le plus de questions -->
        <?php
    $query = "SELECT projets.nom_projet, COUNT(questions.id_question) as total_questions
              FROM projets
              LEFT JOIN questions ON projets.id_projets = questions.projet_id
              GROUP BY projets.id_projets
              ORDER BY total_questions DESC
              LIMIT 3";

    $result = mysqli_query($conn, $query);
    ?>

        <div class="container1 mt-5">
            <h2 class="mb-4">Projet avec le plus de questions :</h2>

            <?php if ($result && mysqli_num_rows($result) > 0) : ?>
            <?php $row = mysqli_fetch_assoc($result); ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['nom_projet'] ?></h5>
                    <p class="card-text"><?= $row['total_questions'] ?> questions</p>
                </div>
            </div>
            <?php else : ?>
            <div class="alert alert-warning" role="alert">
                Aucun projet trouvé.
            </div>
            <?php endif; ?>
        </div>

        <!-- Statistiques sur l'utilisateur avec le plus de réponses -->
        <?php
    $query = "SELECT users.First_name, users.Last_name, 
              COALESCE(COUNT(DISTINCT reponses.id_reponse), 0) as total_reponses
              FROM users
              LEFT JOIN questions ON users.id_user = questions.user_id
              LEFT JOIN reponses ON questions.id_question = reponses.question_id
              GROUP BY users.id_user
              ORDER BY total_reponses DESC
              LIMIT 1";

    $result = mysqli_query($conn, $query);
    ?>

        <div class="container1 mt-5 mb-4 ">
            <h2 class="mb-4">Utilisateur avec le plus de réponses :</h2>

            <?php if ($result && mysqli_num_rows($result) > 0) : ?>
            <?php $row = mysqli_fetch_assoc($result); ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['First_name'] ?> <?= $row['Last_name'] ?></h5>
                    <p class="card-text"><?= $row['total_reponses'] ?> réponses</p>
                </div>
            </div>
            <?php else : ?>
            <div class="alert alert-warning" role="alert">
                Aucun utilisateur trouvé.
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php
    mysqli_close($conn);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
