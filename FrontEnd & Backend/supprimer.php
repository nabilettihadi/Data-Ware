<?php
include "connexion.php";
include "../src/ProductOwner.php";
session_start();
$projectManager = new ProductOwner($conn, $_SESSION['usernamme']);

$id = $_GET['id'];

if ($projectManager->deleteProject($id)) {
    header("Location: DashboardM.php");
}
?>