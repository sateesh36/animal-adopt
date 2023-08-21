<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="form">
        <p>Hello, <?php echo $_SESSION['username']; ?>!</p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>

</html>