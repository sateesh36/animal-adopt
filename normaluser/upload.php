<?php 

if (isset($_POST['rescuesubmit']) && isset($_FILES['my_image'])) {
	include "../globalfiles/config.php";

$img_name = $_FILES['my_image']['name'];
$img_size = $_FILES['my_image']['size'];
$tmp_name = $_FILES['my_image']['tmp_name'];
$error = $_FILES['my_image']['error'];



$fullname= $_POST['fullname'];
$number= $_POST['number'];
$breed= $_POST['breed'];
$quantity= $_POST['quantity'];
$date= $_POST['date'];
$address= $_POST['address'];
$message= $_POST['message'];

if (strlen($number)<10) {
	$numerror = "mobile number should be of 10 digits!";
}elseif (!preg_match("/^[6-9]\d{9}$/",$number)) {
	$numerror = "invalid mobile number!";
}

	if ($error === 0) {		if ($img_size > 10000000) {
			$em = "Sorry, your file is too large.";
		    header("Location: index.php?error=$em");
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
					$sql = "INSERT INTO `rescue_form`( `fullname`, `number`, `breed`, `image`, `quantity`, `date`, `address`, `message` ) VALUES('$fullname','$number','$breed','$new_img_name','$quantity', '$date','$address','$message')";
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

}else {
	header("Location: index.php");
	exit;
}
?>
