<?php
class AuthManager
{
    public static function authenticateUser()
    {
        session_start();
        if ($_SESSION['autoriser'] != "oui") {
            header("Location: index.php");
            exit();
        }
        if ($_SESSION['role'] != "product_owner") {
            header("Location: community.php");
            exit();
        }
    }
}
?>
