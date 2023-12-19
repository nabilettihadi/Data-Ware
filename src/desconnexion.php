<?php
class Logout
{
    public function __construct()
    {
        session_start();
        session_destroy();
        $this->redirect("index.php");
    }

    public function redirect($location)
    {
        header("Location: $location");
        exit();
    }
}

?>