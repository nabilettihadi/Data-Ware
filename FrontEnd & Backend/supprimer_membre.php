<?php
include "connexion.php";
include "../src/deleteMembre.php";
$membre_id = $_GET['membre_id'];
$userManager = new UserManager($conn);
$result = $userManager->removeUserFromTeam($membre_id);
if ($result) {
    header("Location: Gestionequi.php");
    exit();
}

?>
