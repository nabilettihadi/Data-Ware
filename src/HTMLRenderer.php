<?php

class HTMLRenderer
{
    public static function renderHeader()
    {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
            <link rel="stylesheet" href="style.css" type="text/css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <title>Document</title>
        </head>
        <body>
        ';
    }

    public static function renderNavbar($role)
    {
        echo '
        <header>
            <nav class="navbar navbar-expand-lg navbar-scroll shadow-0 border-bottom border-dark">
                <!-- Add your navbar content here -->
                <!-- Use $role parameter to customize the navigation based on the user role -->
            </nav>
        </header>
        ';
    }

    public static function renderFooter()
    {
        echo '
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        ';
    }
}
?>
