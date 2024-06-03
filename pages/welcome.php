<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Welcome
    <?php
    session_start(); // Starting the session
    $name = $_SESSION['username']; // Retrieves the username from the session
    echo $name;
    ?>
</body>
</html>