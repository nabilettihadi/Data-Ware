<?php
session_start();
if($_SESSION['autoriser'] != "oui"){
  header("Location: index.php");
  exit();
}
include "connexion.php";
include('votes.php');

$message="";
$question_id = $_GET['id'];
$_SESSION['question'] = $_GET['id'];
$user= $_SESSION['username'];
$role= $_SESSION['role'];
$sql = "SELECT * FROM questions INNER JOIN users ON questions.user_id  = users.id_user WHERE questions.id_question = $question_id ";

$result = mysqli_query($conn, $sql);
$rowe = mysqli_fetch_assoc($result);
$membre= $_SESSION['id'];

if (isset($_POST["submit"])) {
    $text = $_POST["text"];
    
    $requete = "INSERT INTO reponses (user_id , question_id, contenu) VALUES ('$membre', '$question_id', '$text')";
      $query = mysqli_query($conn, $requete);
      header("Location: Question.php?id=$question_id");
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
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                        <?php
    if($role == "user") {
        ?>
                        <li class="nav-item">
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
                            <a class="nav-link text-center" href="community.php">Community</a>
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
                            <a class="nav-link text-center" href="community.php">Community</a>
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
            <div class="d-flex justify-content-center mt-3 w-25 p-3 d-none d-lg-block ">
                <a href="community.php"
                    class="col-md-auto col-sm-12 bg-danger p-2 rounded-3 text-light text-decoration-none btn mt-1 w-100"><i
                        class="bi bi-arrow-return-left"></i> Retour</a>
                <a href="poser_question.php"
                    class="col-md-auto col-sm-12 bg-primary p-2 rounded-3 text-light text-decoration-none btn mt-4 w-100"><i
                        class="bi bi-bookmark-plus-fill"></i> Poser une question</a>
            </div>
            <div class="vr"></div>
            <div class="d-flex flex-column col w-100 p-4">

                <div class="d-flex  flex-column align-items-start  ">
                    <a href="community.php"
                        class="col-md-auto col-sm-12 bg-danger p-2 rounded-3 text-light text-decoration-none btn mt-1 d-block d-lg-none w-100"><i
                            class="bi bi-arrow-return-left"></i> Retour</a>
                    <a href="poser_question.php"
                        class="col-md-auto col-sm-12 bg-primary p-2 rounded-3 text-light text-decoration-none btn mt-4 d-block d-lg-none w-100"><i
                            class="bi bi-bookmark-plus-fill"></i> Poser une question</a>
                    <h2 class="fw-lighter text-primary mt-3">Questions</h2>
                    <h3 class="mt-3"><?php echo $rowe['titre']; ?></h3>
                    <div class="jumbotron bg w-75 w5 ">
                        <p class="lead mt-3 p-2"><?php echo $rowe['contenu']; ?> </p>
                        <hr class="my-4">
                        <div class="d-flex justify-content-between px-2">
                            <p class="text-end">Poser par : <span
                                    class="text-danger"><?php echo $rowe['First_name']. ' ' . $rowe['Last_name'] ; ?></span>
                            </p>
                            <p class="text-end">Poser le : <span
                                    class="text-primary"><?php echo $rowe['date_creation']; ?></span></p>
                        </div>
                    </div>
                    <h2 class="fw-lighter text-primary mt-3">Réponses</h2>
                    <?php
$sql = "SELECT * FROM reponses INNER JOIN users ON reponses.user_id = users.id_user WHERE reponses.question_id = $question_id AND archive = false  ORDER BY reponses.solution DESC, reponses.date_creation";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    $message = "Il n'y a pas encore de réponse.";
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>

                    <div class="jumbotron bg w-75 mt-2 w5">
                        <div class="d-flex justify-content-between pt-2 px-2 gap-3">
                            <?php
                if ($role == 'scrum_master') {
                    ?>
                            <a href="archiverR.php?id=<?php echo $row['id_reponse']; ?>" class="text-success"><i
                                    class="bi bi-archive-fill"></i></a>
                            <?php
                }

                if ($rowe['user_id'] == $membre && !$row['solution']) {
                    ?>
                            <a href="solution.php?id=<?php echo $row['id_reponse']; ?>"
                                class="text-center btn btn-outline-warning btn-sm h-50"> <i
                                    class="bi bi-bookmark-plus"></i> Marquer comme solution</a>
                            <?php
                }

                if ($row['solution']) {
                    if ($rowe['user_id'] == $membre) {
                        ?>
                            <a href="Sup_solution.php?id=<?php echo $row['id_reponse']; ?>"
                                class="text-center btn btn-warning btn-sm h-50"> <i class="bi bi-bookmark-check"></i>
                                Solution</a>
                            <?php
                    } else {
                        ?>
                            <p class="text-center btn btn-warning btn-sm h-50"> <i class="bi bi-bookmark-check"></i>
                                Solution</p>
                            <?php
                    }
                }
                ?>



                            <p class="text-center"> <span
                                    class="text-primary text-center"><?php echo $row['date_creation']; ?></span></p>
                        </div>

                        <p class="lead  px-2 " style="overflow-wrap: break-word; word-wrap: break-word;">
                            <?php echo $row['contenu']; ?> </p>

                        <hr class="my-4">
                        <div class="d-flex justify-content-between px-2">
                            <p>Répondu par : <span
                                    class="text-danger"><?php echo $row['First_name'] . ' ' . $row['Last_name']; ?></span>
                            </p>

                            <?php
        
                if ($row['user_id'] == $membre) {
                ?>
                            <div class="d-flex justify-content-center me-5">
                                <a href="supprimer_reponse.php?id=<?php echo $row['id_reponse']; ?>"
                                    class="text-danger ms-4 text-center">
                                    <i class=" bi-trash3-fill"></i>
                                </a>
                                <a href="modifier_reponse.php?id=<?php echo $row['id_reponse']; ?>"
                                    class="text-primary ms-4 text-center">
                                    <i class=" bi bi-pencil"></i>
                                </a>
                            </div>
                            <?php
                }
                ?>
                            <div class="d-flex justify-content-end gap-3">
                                <i <?php if (userLiked($row['id_reponse'])): ?> class="fa fa-thumbs-up like-btn "
                                    <?php else: ?> class="fa fa-thumbs-o-up like-btn " <?php endif ?>
                                    data-id="<?php echo $row['id_reponse'] ?>"></i>
                                <span class="likes"><?php echo getLikes($row['id_reponse']); ?></span>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <i <?php if (userDisliked($row['id_reponse'])): ?>
                                    class="fa fa-thumbs-down dislike-btn " <?php else: ?>
                                    class="fa fa-thumbs-o-down dislike-btn " <?php endif ?>
                                    data-id="<?php echo $row['id_reponse'] ?>"></i>
                                <span class="dislikes"><?php echo getDislikes($row['id_reponse']); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
    }
}
?>


                    <p class="text-center fs-5 fw-bolder text-danger"><?php echo $message;?></p>

                    <form method="post" action="" class="w-75 w5 ">
                        <h2 class="fw-lighter text-primary mt-3">Répondre</h2>
                        <div class="form-floating mt-3  ">
                            <textarea name="text" class="form-control bg h-80" placeholder="Leave a comment here"
                                id="floatingTextarea"></textarea>
                            <label for=" floatingTextarea">Votre reponse</label>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" name="submit"
                                class="col-md-auto col-sm-12 bg-primary p-2 rounded-3 text-light text-decoration-none btn mt-2">
                                <i class="bi bi-file-post"></i> Publier votre réponse</button>
                        </div>
                    </form>




                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
                    </script>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
                    <!-- Include jQuery library -->
                    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                    <script>
                    $(document).ready(function() {

                        // if the user clicks on the like button ...
                        $('.like-btn').on('click', function() {
                            var reponse_id = $(this).data('id');
                            $clicked_btn = $(this);

                            if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
                                action = 'like';
                            } else if ($clicked_btn.hasClass('fa-thumbs-up')) {
                                action = 'unlike';
                            }

                            $.ajax({
                                url: 'Question.php', // Replace with the correct PHP script handling votes
                                type: 'post',
                                data: {
                                    'action': action,
                                    'reponse_id': reponse_id
                                },
                                success: function(data) {
                                    res = JSON.parse(data);
                                    if (action == "like") {
                                        $clicked_btn.removeClass(
                                            'fa-thumbs-o-up ');
                                        $clicked_btn.addClass('fa-thumbs-up ');
                                    } else if (action == "unlike") {
                                        $clicked_btn.removeClass('fa-thumbs-up');
                                        $clicked_btn.addClass('fa-thumbs-o-up');
                                    }

                                    // display the number of likes and dislikes
                                    $clicked_btn.siblings('span.likes').text(res.likes);
                                    $clicked_btn.siblings('span.dislikes').text(res
                                        .dislikes);

                                    // change button styling of the other button if user is reacting the second time to post
                                    $clicked_btn.siblings('i.fa-thumbs-down').removeClass(
                                            'fa-thumbs-down')
                                        .addClass('fa-thumbs-o-down');
                                }
                            });
                        });

                        // if the user clicks on the dislike button ...
                        $('.dislike-btn').on('click', function() {
                            var reponse_id = $(this).data('id');
                            $clicked_btn = $(this);

                            if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
                                action = 'dislike';
                            } else if ($clicked_btn.hasClass('fa-thumbs-down')) {
                                action = 'undislike';
                            }

                            $.ajax({
                                url: 'Question.php', // Replace with the correct PHP script handling votes
                                type: 'post',
                                data: {
                                    'action': action,
                                    'reponse_id': reponse_id
                                },
                                success: function(data) {
                                    res = JSON.parse(data);
                                    if (action == "dislike") {
                                        $clicked_btn.removeClass('fa-thumbs-o-down');
                                        $clicked_btn.addClass('fa-thumbs-down');
                                    } else if (action == "undislike") {
                                        $clicked_btn.removeClass('fa-thumbs-down');
                                        $clicked_btn.addClass('fa-thumbs-o-down');
                                    }

                                    // display the number of likes and dislikes
                                    $clicked_btn.siblings('span.likes').text(res.likes);
                                    $clicked_btn.siblings('span.dislikes').text(res
                                        .dislikes);

                                    // change button styling of the other button if user is reacting the second time to post
                                    $clicked_btn.siblings('i.fa-thumbs-up').removeClass(
                                            'fa-thumbs-up')
                                        .addClass('fa-thumbs-o-up');
                                }
                            });
                        });

                        // if the user clicks on the mark as solution button ...
                        $('.mark-solution-btn').on('click', function() {
                            var reponse_id = $(this).data('id');

                            $.ajax({
                                url: 'MarkSolution.php',
                                type: 'post',
                                data: {
                                    'reponse_id': reponse_id
                                },
                                success: function(data) {
                                    res = JSON.parse(data);
                                    if (res.success) {
                                        alert('Answer marked as solution!');
                                        // Refresh the page or update the UI dynamically
                                        location.reload();
                                    } else {
                                        alert('Error marking answer as solution');
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error('Error marking solution:', textStatus,
                                        errorThrown);
                                }
                            });
                        });

                    });
                    </script>


</body>

</html>