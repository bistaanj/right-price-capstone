<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="icon" type="image/x-icon" href="../images/RightPriceLogo.ico">
    
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["session_id"])) {
        header("Location: ../pages/login.php");
    }

    ?>
    Welcome
    <?php
    $name = $_SESSION['username'];
    echo $name;
    ?>
    <div class="">
        <?php
        $sessionId = $_SESSION['session_id'];
        echo $sessionId;
        ?>
    </div>
    <div class="">
        <form action="../php/logout.php" method='post'>
            <button type="submit" name="submit"> Logout</button>
    </form>
    </div>
   </body>
</html>