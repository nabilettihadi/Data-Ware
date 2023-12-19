<?php
session_start();
include "connexion.php";

$question_id = $_GET['id'];
$req=mysqli_query($conn, "UPDATE questions SET archiver = true WHERE id_question = $question_id");
header("Location: community.php");


?>