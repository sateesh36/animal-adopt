<?php

include '../globalfiles/config.php';

session_start();

error_reporting(0);


if (!isset($_SESSION['admin_name'])) {
    header("Location: adminlogin.php");
}

if (isset($_SESSION['sestime']) && (time() - $_SESSION['sestime'] > 600)) {
    session_unset();
    session_destroy();
    header("Location: adminlogin.php");
    exit;
    $_SESSION['sestime'] = time();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="Style.css">
    
    <script src="jquery-3.5.1.min.js"></script>
</head>

<body class="index">
    

    <div class="wrap">


        <div class="sidebar opensidebar">
            <img src="menu.png" alt="" id="menuicon">
            <a href="index.php">
                <h1>Dashboard</h1>
            </a>
            <ul>
                <li><a href="rescueRequest.php">Rescue Request</a></li>
                <li><a href="adoptedpets.php">Adopted Pets</a></li>
                <li><a href="availablePets.php">Available Pets</a></li>
                <li><a href="userfeedback.php">User's Feedback</a></li>
            </ul>
        </div>

        <div class="display">
            
            <h1>
                <!-- Welcome, <br> -->
                <h2>
                    <?php echo  $_SESSION['admin_name']; ?>
                </h2>
            </h1>
            <a href="../globalfiles/logout.php">logout</a>
        </div>

    </div>
    

    <script>
        $(document).ready(function() {

            $("#menuicon").click(function() {
                $(".sidebar").toggleClass("opensidebar")
            });

        });
    </script>
</body>

</html>