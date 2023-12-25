<?php
session_start();
if ($_SESSION['autoriser'] != "oui") {
  header("Location: index.php");
  exit();
}
require_once "../src/ProductOwner.php";

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $supprimer = new ProductOwner();
  $supprimer->deleteProjetById($id);
}

?>