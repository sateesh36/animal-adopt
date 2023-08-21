<?php 

include '../globalfiles/config.php';

session_start();

error_reporting(0);

if (!isset($_SESSION['username'])) {
    header("Location: lognregister.php");
}else{
    $username = $_SESSION['username'];
}

if (isset($_POST['submit'])) {
// phone number validation
if (empty($_POST['number'])) {
    $numerror = "please enter mobile number!";
}elseif (strlen($_POST['number'])<10) {
    $numerror = "mobile number should be of 10 digits!";
}elseif (!preg_match("/^[6-9]\d{9}$/",$_POST['number'])) {
    $numerror = "invalid mobile number!";
}else{

    $number= $_POST['number'];
    $sql = "INSERT INTO `phone` (`id`, `number`) VALUES (NULL, '$number');";
    mysqli_query($conn, $sql);
}
}
            
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="phonevalid.php" method="post">
        <input type="number" name="number" id="number">
        <span class="error"><?php   echo $numerror; ?></span>
        <input type="submit" name="submit" id="submit">
    </form>
</body>
</html>