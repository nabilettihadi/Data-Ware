<?php
include "connexion.php";
include "../src/delete-project.php";

$projectManager = new ProjectManager($conn);

$id = $_GET['id'];

if ($projectManager->deleteProject($id)) {
    header("Location: DashboardM.php");
}
?>
