<?php
session_start();
if($_SESSION['autoriser'] != "oui"){
  header("Location: index.php");
  exit();
}
include "connexion.php";
$message="";
$membre= $_SESSION['id'];
$user= $_SESSION['username'];
$role= $_SESSION['role'];

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Document</title>



</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-scroll  shadow-0 border-bottom border-dark">
            <div class="container">

                <img src="../Image/log.png" alt="logo" class="rounded-4" style="width: 80px; height: 60px;">
                <div class="input-group w-50 ms-md-4 ">
                    <input type="search" id="myInput" class="form-control rounded" placeholder="Search"
                        aria-label="Search" aria-describedby="search-addon" />
                    <button type="button" class="btn btn-outline-primary" data-mdb-ripple-init><i
                            class="bi bi-search"></i></button>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class=" text-light bi bi-list"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ms-auto d-flex gap-5">
                        <?php
    if($role == "user") {
        ?> <li class="nav-item">
                            <a class="nav-link text-center" href="community.php">Community</a>
                        </li>

                        <li class="nav-item w-1">
                            <a class="nav-link text-center" href="Gestionequi.php">Equipes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-center" href="Assignation.php">Projets</a>
                        </li>
                        <li class="nav-item">
                            <a href="deconnexion.php"
                                class="btn bg-danger p-2 rounded-3 text-light text-decoration-none d-flex gap-1 ">
                                <i class="bi bi-box-arrow-left"> </i>
                                <p class="m-0"> Deconnexion </p>
                            </a>
                        </li>
                        <?php
    } elseif($role == "scrum_master") {
        ?>
                        <li class="nav-item">
                            <a class="nav-link text-center" href="DashboardScrum.php">Community</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-center" href="DashboardScrum.php">Equipes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-center" href="Gestionequi.php">Membres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-center" href="Assignation.php">Assignation</a>
                        </li>
                        <li class="nav-item">
                            <a href="deconnexion.php"
                                class="btn bg-danger p-2 rounded-3 text-light text-decoration-none d-flex gap-1 ">
                                <i class="bi bi-box-arrow-left"> </i>
                                <p class="m-0"> Deconnexion </p>
                            </a>
                        </li>

                        <?php
    } else {
        ?>
                        <li class="nav-item">
                            <a class="nav-link text-center" href="DashboardScrum.php">Community</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link" href="DashboardM.php">Projets</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link" href="MembreP.php">Membres</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link" href="assigner.php">Assignation</a>
                        </li>
                        <li class="nav-item">
                            <a href="deconnexion.php"
                                class="btn bg-danger p-2 rounded-3 text-light text-decoration-none d-flex gap-1 ">
                                <i class="bi bi-box-arrow-left"> </i>
                                <p class="m-0"> Deconnexion </p>
                            </a>
                        </li>
                        <?php
    }
    ?>
                    </ul>

                </div>
            </div>
        </nav>



        <div class="d-flex flex-lg-row justify-content-between flex-sm-column flex-md-column">
            <div class="d-flex justify-content-center mt-5 w-25 p-3 d-none d-lg-block ">
                <a href="community.php"
                    class="col-md-auto col-sm-12 bg-danger p-2 rounded-3 text-light text-decoration-none btn mt-1 w-100"><i
                        class="bi bi-arrow-return-left"></i> Retour</a>
            </div>
            <div class="vr"></div>
            <div class="d-flex flex-column col w-auto w-md-75">

                <div class="d-flex  flex-column align-items-center ">
                    <div class="d-flex justify-content-center mt-1 w-25 p-3 d-block d-lg-none w-75 ">
                        <a href="community.php"
                            class="col-md-auto col-sm-12 bg-danger p-2 rounded-3 text-light text-decoration-none btn mt-1 w-100"><i
                                class="bi bi-arrow-return-left"></i> Retour</a>

                    </div>
                    <h1 class="fw-lighter text-primary mt-3"> Mes Questions</h1>

                    <a href="poser_question.php"
                        class="col-md-auto col-sm-12 bg-primary p-2 rounded-3 text-light text-decoration-none btn mt-4 w-75"><i
                            class="bi bi-bookmark-plus-fill"></i> Poser une question </a>



                    <div class="d-flex flex-column align-items-center w-100">
                        <?php

$sql = "SELECT * FROM questions 
        INNER JOIN users ON questions.user_id = users.id_user INNER JOIN projets ON questions.projet_id = projets.id_projets
        WHERE users.id_user = $membre AND archiver = false
        ORDER BY questions.date_creation DESC";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $question_id = $row['id_question'];
        ?>
                        <div class="card w-75 mt-4 mb-3">
                            <div class="card-header d-flex justify-content-between text-danger">
                                <p><?php echo $row['First_name']. ' ' . $row['Last_name'] ; ?></p>
                                <p><?php echo $row['date_creation']; ?></p>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <a href="Question.php?id=<?=$row['id_question']?>"
                                    class="text-decoration-none text-dark">
                                    <h3><?php echo $row['titre']; ?></h3>
                                </a>
                                <div class="d-flex gap-2 mt-2">
                                    <!-- Affichez ici les balises des tags -->
                                    <?php
                             $sqle = "SELECT * FROM questions 
                             JOIN question_tags ON questions.id_question = question_tags.question_id
                             JOIN tags  ON question_tags.tag_id = tags.id_tag WHERE questions.id_question = $question_id";
                     
                     $resulte = mysqli_query($conn, $sqle);
                            while ($rows = mysqli_fetch_assoc($resulte)) {
                                ?>
                                    <p class="btn btn-outline-primary"><?php echo $rows['nom_tag']; ?></p>
                                    <?php
                            }
                            ?>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <p class="fw-bold">Projet : <span class="text-danger fw-normal">
                                            <?php echo $row['nom_projet']; ?></span></p>
                                    <div class="d-flex justify-content-center me-5">
                                        <a href="supprimer_question.php?id=<?php echo $row['id_question']; ?>"
                                            class="text-danger ms-4 text-center">
                                            <i class=" bi-trash3-fill"></i>
                                        </a>
                                        <a href="modifQ.php?id=<?php echo $row['id_question']; ?>"
                                            class="text-primary ms-4 text-center">
                                            <i class=" bi bi-pencil"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php
    }
} 
?>

                    </div>



                </div>

            </div>








            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>