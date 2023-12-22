<?php
include "connexion.php";
include "../src/ScrumMaster.php";

session_start();

$message = "";
$user= $_SESSION['username'];
$membre= $_SESSION['id'];
$id = $_GET['id'];
$scrumMaster = new ScrumMaster($conn, $user, $membre);
$scrumMaster->supprimerEquipe($id,$membre);

?>