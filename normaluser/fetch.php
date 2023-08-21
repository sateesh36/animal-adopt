
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php
include '../globalfiles/config.php';

session_start();

error_reporting(0);

if (!isset($_SESSION['username'])) {
    header("Location: lognregister.php");
}else{
    $username = $_SESSION['username'];
}

if(isset($_SESSION['sestime']) && (time() - $_SESSION['sestime'] > 600)) {
    session_unset(); session_destroy();
    header("Location: lognregister.php");
    exit;
    }
    $_SESSION['sestime'] = time();


$sql = "SELECT * FROM fetching_data;"; // Please look at this too.
$result = mysqli_query($sql);
if(!result){
    echo "error";
    die;
}
while ($row = mysql_fetch_assoc($result)){     // here too, you put a space between it

    $id=$row['id'];
    $name=$row['name'];
    $image=$row['image'];
    $descr=$row['descr'];
    // echo "<table>
    //     <th>".$row['id']."</th>
    //     <td>".$row['name']."</td>
    //     <td>".$row['image']."</td>
    //     <td>".$row['descr']."</td>
    // </table>";
    // }



// ?>
  <!-- <table>
//         <th></th>
//         <td></td>
//         <td></td>
//         <td></td>
//     </table> -->
}
</body>
</html>