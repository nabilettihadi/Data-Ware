<?php
session_start();
if($_SESSION['autoriser'] != "oui"){
  header("Location: index.php");
  exit();
}
require_once "../src/ScrumMaster.php";
$membre= $_SESSION['id'];
$id=$_GET['id'];

$delete= new ScrumMaster();
$delete->deleteEquipeById($id,$membre);




?>