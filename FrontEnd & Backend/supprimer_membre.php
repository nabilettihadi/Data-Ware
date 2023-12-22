<?php
include "connexion.php";
include "../src/ScrumMaster.php";
session_start();
$user= $_SESSION['username'];
$membre= $_SESSION['id'];
$membre_id = $_GET['membre_id'];

$scrumMaster = new ScrumMaster($conn, $user, $membre);
$scrumMaster->supprimerMembre($scrumMaster);

?>
