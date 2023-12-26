<?php
session_start();
if ($_SESSION['autoriser'] != "oui") {
    header("Location: index.php");
    exit();
}
require_once "../src/ProductOwner.php";
$user = $_SESSION['username'];
$productOwner = new ProductOwner();
$users = $productOwner->getUsersWithRole();
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
                            <a class="nav-link" href="Dashboard-PO.php">Projets</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link" href="Membre-PO.php">Membres</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link" href="Assigner-Scrum.php">Assignation</a>
                        </li>

                        <a href="Deconnexion.php"
                            class="btn bg-danger p-2 rounded-3 text-light text-decoration-none "><i
                                class="bi bi-box-arrow-left"></i> Deconnexion</a>
                    </ul>
                </div>
            </div>
        </nav>
        <h5 class="mt-2 ms-2">Bienvenue
            <?php echo $user; ?> !
        </h5>
  
        <h1 class="d-flex justify-content-center mt-5"> Gestion du Membres </h1>

        <div class="container mt-4">
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-primary mt-4 table-hover">
                            <thead>
                                <tr>
                                    <th class=" align-middle"> Nom </th>
                                    <th class=" align-middle">Prénom</th>
                                    <th class=" align-middle">Email</th>
                                    <th class=" align-middle">Role</th>
                                    <th class=" align-middle">Modifier le role</th>
                                </tr>
                            </thead>
                            <?php
                            foreach ($users as $user) {

                                ?>
                                <tbody class="table-light ">
                                    <tr>
                                        <td>
                                            <?= $user['Last_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['First_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['email']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['role']; ?>
                                        </td>
                                        <td><a href="Modifier-Role.php?id=<?= $user['id_user'] ?>" class="ms-5"><i
                                                    class="bi bi-pencil"></i></a></th>


                                    </tr>
                                </tbody>
                                <?php
                            } ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- <p class="text-center fs-5 fw-bolder text-danger"><?php echo $message; ?></p> -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>