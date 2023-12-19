<?php
include "connexion.php";
include "../src/assignation.php";
$dashboard = new ScrumMasterDashboard($conn);
$dashboard->displayHeader();
$dashboard->displayTable();
$dashboard->displayFooter();
?>