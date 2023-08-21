<?php
include("trashconfig.php");

if(isset($_POST['submit'])){
    $name = $_POST['dogname'];
    $descr = $_POST['descr'];

    $img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];
	
	

	if ($error === 0) {
		if ($img_size > 10000000) {
			$em = "Sorry, your file is too large.";
		    header("Location: index.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);
				$sql = "INSERT INTO `fetching_data`( `name`, `image`, `descr` ) VALUES('$name','$new_img_name','$descr')";
				mysqli_query($conn, $sql);
				header("Location: index.php?success");
			}else {
				$em = "You can't upload files of this type";
		        header("Location: index.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: index.php?error=$em");
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
	<style>
		form{
			display:flex;
			flex-direction: column;
			padding:auto;
			width:500px;
			margin:auto;
			margin-top: 50px;
		}
		input{
			width:400px;
			height:40px;
		}
	</style>
</head>
<body>
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="dogname" id="dogname" required><br><br>
        <input type="text" name="descr" id="descr" required><br><br>
        <input type="file" name="my_image" id="image" required><br><br>
        <input type="submit" name="submit" id="submit"><br><br>
    </form>
</body>
</html>
