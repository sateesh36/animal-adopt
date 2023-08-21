<?php 

if (isset($_POST['upsubmit2']) && isset($_FILES['descriptionEdit'])) {
	include "../globalfiles/config.php";

	echo "<pre>";
	print_r($_FILES['descriptionEdit']);
	echo "</pre>";
$img_name = $_FILES['descriptionEdit']['name'];
$img_size = $_FILES['descriptionEdit']['size'];
$tmp_name = $_FILES['descriptionEdit']['tmp_name'];
$error = $_FILES['descriptionEdit']['error'];

$title= $_POST['titleEdit'];
$sno = $_POST["snoEdit"];
$species = $_POST['speciesEdit'];
$breed = $_POST['breedEdit'];
$health_condition = $_POST['conditionedit'];
$age = $_POST['ageEdit'];

	if ($error === 0) {		if ($img_size > 10000000) {
			$em = "Sorry, your file is too large.";
		    header("Location: availablepets.php?error=$em");
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
                $sql = "UPDATE `availablepets` SET `title` = '$title' , `description` = '$new_img_name', `species` = '$species', `breed` = '$breed', `health_condition` = '$health_condition', `age` = '$age' WHERE `availablepets`.`sno` = $sno";
        // $sql = "INSERT INTO `availablepets` (`title`, `description`) VALUES ('$title', '$new_img_name')";
		// $sql = "INSERT INTO `rescue_form`( `fullname`, `number`, `breed`, `image`, `quantity`, `date`, `address`, `message` ) VALUES('$fullname','$number','$breed','$new_img_name','$quantity', '$date','$address','$message')";
					mysqli_query($conn, $sql);
					header("Location: availablepets.php?success");
				
							

			}else {
				$em = "You can't upload files of this type";
		        header("Location: availablepets.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: availablepets.php?error=$em");
	}

}else {
	header("Location: availablepets.php");
}
