<?php
session_start();
include "connexion.php";
$id=$_SESSION['question'];

$reponse_id = $_GET['id'];
$req=mysqli_query($conn, "UPDATE reponses SET archive = true WHERE id_reponse = $reponse_id");
header("Location: Question.php?id=$id");


?>