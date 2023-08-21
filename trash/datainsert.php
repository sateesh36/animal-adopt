<?php

include("trashconfig.php");

if (isset($_POST['submit'])) {
	$name = $_POST['tname'];
	$image = $_POST['timage'];
        $sql = "INSERT INTO cats (name, img_dir) VALUES ('$name', '$image')";
        $result = mysqli_query($conn, $sql);
    // } else{
    //     echo "wrong extension";
    //     die;
    // }
    if(!$result){
        echo "error";
        die;
    }else{
        echo "good";
        die;
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
    <form action="" method="POST" >
        <input type="text" name="tname" value="" multiple="">
        <input type="file" name="timage" value="" multiple="">
        <input type="submit" name="submit" value="upload" >
    </form>
</body>
</html>