<?php 

if (isset($_POST['submit2']) && isset($_FILES['description'])) {
	include "../globalfiles/config.php";

	// echo "<pre>";
	// print_r($_FILES['description']);
	// echo "</pre>";
$img_name = $_FILES['description']['name'];
$img_size = $_FILES['description']['size'];
$tmp_name = $_FILES['description']['tmp_name'];
$error = $_FILES['description']['error'];
$title= $_POST['title'];
$species = $_POST['species'];
$breed = $_POST['breed'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$weight = $_POST['weight'];
$weight_with_unit = $weight . " kg";
$doctor_contact = $_POST['doctor_contact'];
$health_condition = $_POST['health_condition'];
$owner_contact = $_POST['owner_contact'];


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
        			// $sql = "INSERT INTO `availablepets` (`title`, `description`, 'details') VALUES ('$title', '$new_img_name', '$details')";
                    $sql = "INSERT INTO `availablepets` (`title`, `description`, `species`, `breed`, `age`, `gender`, `weight`, `doctor_contact`, `health_condition`, `owner_contact`) VALUES ('$title', '$img_upload_path', '$species', '$breed', '$age', '$gender', '$weight_with_unit', '$doctor_contact', '$health_condition', '$owner_contact')";

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

?>
<!-- 
if (isset($_POST['submit2']) && isset($_FILES['description']) && isset($_FILES['details'])) {
    include "../globalfiles/config.php";

    $img_name = $_FILES['description']['name'];
    $img_size = $_FILES['description']['size'];
    $tmp_name = $_FILES['description']['tmp_name'];
    $error = $_FILES['description']['error'];
    $title = $_POST['title'];

    if ($error === 0) {
        if ($img_size > 10000000) {
            $em = "Sorry, your file is too large.";
            header("Location: availablepets.php?error=$em");
            exit();
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            // if (in_array($img_ex_lc, $allowed_exs)) {
            //     // Generate the new image file name with the desired title and original extension
            //     $new_img_name = $title . '.' . $img_ex_lc;
            //     $img_upload_path = '../uploads/' . $new_img_name;
            //     move_uploaded_file($tmp_name, $img_upload_path);
			if(in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = '../uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

                // Get the original details.txt file extension
                $details_name = $_FILES['details']['name'];
                $details_ex = pathinfo($details_name, PATHINFO_EXTENSION);

                // Generate the new details file name with only the desired title
                $new_details_name = $title . '.' . $details_ex;
                $details_tmp_name = $_FILES['details']['tmp_name'];
                $details_path = '../details/';
                $details_file_path = $details_path . $new_details_name;
                move_uploaded_file($details_tmp_name, $details_file_path);

                // Sanitize the inputs to prevent SQL injection
                $title = mysqli_real_escape_string($conn, $title);
                $img_upload_path = mysqli_real_escape_string($conn, $img_upload_path);
                $details_file_path = mysqli_real_escape_string($conn, $details_file_path);

                // Insert into Database
                $sql = "INSERT INTO `availablepets` (`title`, `description`, `details`) VALUES ('$title', '$img_upload_path', '$details_file_path')";
                mysqli_query($conn, $sql);

                header("Location: availablepets.php?success");
                exit();
            } else {
                $em = "You can't upload files of this type";
                header("Location: availablepets.php?error=$em");
                exit();
            }
        }
    } else {
        $em = "Unknown error occurred!";
        header("Location: availablepets.php?error=$em");
        exit();
    }
} else {
    header("Location: availablepets.php");
    exit();
}
 -->
