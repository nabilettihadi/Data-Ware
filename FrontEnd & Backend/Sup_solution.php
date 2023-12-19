<?php
session_start();
include "connexion.php";
$reponse_id = $_GET['id'];
$id=$_SESSION['question'];

$req=mysqli_query($conn, "UPDATE reponses SET solution = false WHERE question_id = $id  AND id_reponse = $reponse_id");
header("Location: Question.php?id=$id");


?>