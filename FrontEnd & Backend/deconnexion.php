<?php
include "connexion.php";
include "../src/user.php";
$authentification = new User($conn, "", 0, "");
$authentification->redirect("index.php");
?>