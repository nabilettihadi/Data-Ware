<?php
include "connexion.php";
include "../src/ProductOwner.php";

session_start();

if(isset($_SESSION['autoriser']) && $_SESSION['autoriser'] == "oui" && isset($_SESSION['role']) && $_SESSION['role'] == "product_owner") {
    $productOwner = new ProductOwner($conn, $_SESSION['username']);
    $productOwner->renderProjectsPage();
} else {
    header("Location: index.php");
    exit();
}
?>
