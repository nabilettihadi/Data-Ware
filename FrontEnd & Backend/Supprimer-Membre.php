<?php
require_once "../src/ScrumMaster.php";

$membre_id = $_GET['membre_id'];
$delete = new ScrumMaster();
$delete->deleteMember($membre_id);

?>