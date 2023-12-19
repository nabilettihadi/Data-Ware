<?php
session_start();
if($_SESSION['autoriser'] != "oui"){
  header("Location: index.php");
  exit();
}
include "connexion.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["search"])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET["search"]);

    // Recherche par titre ou tag using prepared statements
    $sql = "
        SELECT DISTINCT questions.*
        FROM questions
        LEFT JOIN question_tags ON questions.id_question = question_tags.question_id
        LEFT JOIN tags ON question_tags.tag_id = tags.id_tag
        WHERE questions.titre LIKE ? OR tags.nom_tag LIKE ?
    ";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $searchTerm, $searchTerm);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Recherche de Questions</title>
    <style>
    .result-table {
        margin-top: 20px;
    }
    </style>
</head>

<body class="vh-100" style="background-color: #6BA7F0;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="d-flex justify-content-end px-3 py-1">
                        <a href="Gestionequi.php" class="text-danger fs-5">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none px-2 d-md-flex align-items-center">
                            <img src="../Image/ajouter.jpg" alt="login form" class="img-fluid" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body text-black">
                                <!-- Formulaire unique pour la recherche par titre et tag -->
                                <form method="get" action="">
                                    <h5 class="fw-semibold mb-3 mt-3 pb-3" style="letter-spacing: 1px;">Recherche de
                                        Questions</h5>
                                    <div class="mb-3">
                                        <label for="search" class="my-2">Recherche par Titre ou Tag:</label>
                                        <div class="input-group">
                                            <input type="text" name="search" id="search" class="form-control"
                                                placeholder="Entrez le titre ou le tag">
                                            <button type="submit" class="btn btn-primary">Rechercher</button>
                                        </div>
                                    </div>
                                </form>

                                <?php
                                // Affichage des résultats après le traitement du formulaire
                                if (isset($result) && mysqli_num_rows($result) > 0) {
                                    echo '<div class="result-table">';
                                    echo '<table class="table table-bordered">';
                                    echo '<thead><tr><th>ID</th><th>Titre</th><th>Contenu</th></tr></thead>';
                                    echo '<tbody>';
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    // HTML encode to prevent XSS
                                    echo "<tr><td>{$row["id_question"]}</td><td>" . htmlspecialchars($row["titre"]) . "</td><td>" . htmlspecialchars($row["contenu"]) . "</td></tr>";
                                    }
                                    echo '</tbody></table>';
                                    echo '</div>';
                                } else {
                                echo "Aucun résultat trouvé.";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>