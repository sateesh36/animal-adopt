<?php 

if (isset($_POST['submit']) && isset($_FILES['description'])) {
	include "../globalfiles/config.php";

	// echo "<pre>";
	// print_r($_FILES['description']);
	// echo "</pre>";
$img_name = $_FILES['description']['name'];
$img_size = $_FILES['description']['size'];
$tmp_name = $_FILES['description']['tmp_name'];
$error = $_FILES['description']['error'];

$title= $_POST['title'];

	if ($error === 0) {		if ($img_size > 10000000) {
			$em = "Sorry, your file is too large.";
		    header("Location: adoptedpets.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

				
				if(in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = '../uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

					// Insert into Database
					// id name email password image desc
					// fullname	 number	 breed	 image	quantity	date	address	 message
        			$sql = "INSERT INTO `adoptedpets` (`title`, `description`) VALUES ('$title', '$new_img_name')";
		// $sql = "INSERT INTO `rescue_form`( `fullname`, `number`, `breed`, `image`, `quantity`, `date`, `address`, `message` ) VALUES('$fullname','$number','$breed','$new_img_name','$quantity', '$date','$address','$message')";
					mysqli_query($conn, $sql);
					header("Location: adoptedpets.php?success");
				
							

			}else {
				$em = "You can't upload files of this type";
		        header("Location: adoptedpets.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: adoptedpets.php?error=$em");
	}

}else {
	header("Location: adoptedpets.php");
}
