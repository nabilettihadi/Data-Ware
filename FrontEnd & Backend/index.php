<?php
session_start();
include "connexion.php";
include "../src/user.php";

$authentification = new User($conn, "", 0, "");

$erreur = "";
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $authentification->authenticate($email, $pass);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <section class="vh-100" style="background-color: #5483BC;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-flex align-items-center">
                                <img src="../Image/10705723_44658.jpg" alt="login form" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="post" action="">

                                        <div class="d-flex align-items-center justify-content-center mb-3 pb-1">
                                            <img src="../Image/log.png" alt="logo" style="width: 100px;">
                                        </div>

                                        <h5 class="fw-semibold mb-3 pb-3" style="letter-spacing: 1px;">Connectez-vous
                                            votre compte</h5>

                                        <div class="form-floating mb-4">
                                            <input type="email" class="form-control" name="email" id="floatingInput"
                                                placeholder="name@example.com">
                                            <label for="floatingInput" class="text-secondary">Email </label>
                                        </div>
                                        <div class="form-floating mb-4 ">
                                            <input type="password" class="form-control" name="password"
                                                id="floatingPassword" placeholder="Password">
                                            <label for="floatingPassword" class="text-secondary">Mot de
                                                passe</label>
                                            <span class=" text-danger "><?php echo $erreur; ?></span>
                                        </div>

                                        <div class="pt-1 mb-4 d-flex justify-content-end">
                                            <button class="btn btn-primary btn-lg btn-block" name="submit"
                                                type="submit">Connexion</button>
                                        </div>

                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Vous n'avez pas de compte ? <a
                                                href="Inscription.php" style="color: #393f81;">Inscrivez-vous ici</a>
                                        </p>
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
