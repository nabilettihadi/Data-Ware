<?php
include "connexion.php";
include "../src/user.php";
include "../src/Membre.php";

$project = new Membre($conn);
$user = new User($conn, $_SESSION['username'], $_SESSION['id'], $_SESSION['role']);
$user = $_SESSION['username'];
?>
