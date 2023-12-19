<?php
include "connexion.php";
include "../src/deleteTeam.php";

session_start();
$membre = $_SESSION['id'];

// Create an instance of TeamManager
$teamManager = new TeamManager($conn);

$id = $_GET['id'];

// Use the TeamManager method to remove the team
$result = $teamManager->removeTeam($id, $membre);

if ($result) {
    header("Location: DashboardScrum.php");
}
?>