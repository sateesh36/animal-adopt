<?php

include("trashconfig.php");


$sql = "SELECT * FROM fetching_data ORDER BY id DESC ";
$result = $conn->query($sql);
$conn->close(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container{
            width: 100%;
        }
        .card{
            display: block;
            padding: 10px;
            margin:20px;
            border: 2px solid red;
            height:300px;
            width:150px;
        }
    </style>
</head>
<body>
    <?php

    // $sql = "SELECT * FROM fetching_data;";
    // $result = $conn -> query($sql);
    // $row = $result -> fetch_assoc();
    // $result = fetch_assoc($sql);
    
    while($rows=$result->fetch_assoc()){
        ?>
            <form action="dynamic.php">
        <div class="container">
            <div class="card">
                <h1><?php 
                $new = $rows['id'];
                echo $rows['name'];?></h1>
                <p><?php echo $rows['descr'];?></p> 
                <input type="number" name="newid" id="newid" value='<?php ".$new." ?>' hidden>
                    <input type="submit" name="dynamic" value="read more">
                </div>
            </div>
            </form>
            <?php
    }
    ?>
</body>
</html>