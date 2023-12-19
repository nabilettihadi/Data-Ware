<?php

class Session
{
    public static function start()
    {
        session_start();
    }

    public static function checkAuthorization()
    {
        if (!isset($_SESSION['autoriser']) || $_SESSION['autoriser'] !== "oui") {
            header("Location: index.php");
            exit();
        }
    }

    public static function checkRole($allowedRoles)
    {
        $role = isset($_SESSION['role']) ? $_SESSION['role'] : "";

        if (!in_array($role, $allowedRoles)) {
            header("Location: community.php");
            exit();
        }
    }
}
?>
