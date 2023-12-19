<?php
session_start();
if($_SESSION['autoriser'] != "oui"){
  header("Location: index.php");
  exit();
}
include "connexion.php";
$membre= $_SESSION['id'];
$question_id = $_GET['id'];
$req= mysqli_query($conn, "SELECT * FROM questions WHERE id_question= $question_id");
$row=mysqli_fetch_array($req);

if (isset($_POST["submit"])) {
    // Récupérer les valeurs du formulaire
    $titre = $_POST["name"];
    $contenu = $_POST["text"];


      $requete = "UPDATE questions SET contenu='$contenu' , titre='$titre' WHERE id_question=$question_id";
      $query = mysqli_query($conn, $requete);
      header("Location: Mquestion.php");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
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
                            <a class="nav-link text-center" href="Mquestion.php">Mes Question</a>
                        </li>

                        <a href="FrontEnd & Backend/deconnexion.php"
                            class="btn bg-danger p-2 rounded-3 text-light text-decoration-none "><i
                                class="bi bi-box-arrow-left"></i> Deconnexion</a>
                    </ul>
                </div>
            </div>
        </nav>



        <div class="container center mt-4 mb-4 ">
            <div class="row ">
                <div class="col d-flex justify-content-center ">

                    <div class="card  " style="width: 950px;">
                        <div class="card-header navbar-scroll ">
                            <h3 class="mb-0 text-center text-light fw-light w-100">Modifier la question</h3>
                        </div>
                        <div class="card-body bg1 d-flex flex-column align-items-center w-100">
                            <img src="../Image/data.png" class="img-fluid " alt="img">
                            <form method="post" action="">

                            </form>
                            <form method="post" action="">

                                <div class="form-floating mb-3 mt-3 ">
                                    <input type="text" name="name" class="form-control w-100 w" id="floatingInput"
                                        placeholder="name" value="<?=$row['titre']?>" required>
                                    <label class="text-secondary " for="floatingInput">Titre de question</label>
                                </div>
                                <div class="form-floating mt-3  ">
                                    <textarea name="text" class="form-control h-80" placeholder="Leave a comment here"
                                        id="floatingTextarea"><?=$row['contenu']?></textarea>
                                    <label for=" floatingTextarea" class="text-secondary">Contenu</label>
                                </div>
                                <div class="mt-3">
                                    <div class="pt-1 mb-3 d-flex mt-2 justify-content-end">
                                        <button class="btn btn-primary btn-md btn-block " type="submit"
                                            name="submit">Valider</button>
                                    </div>
                                </div>
                            </form>


                        </div>

                    </div>
                </div>
            </div>





</body>

</html>