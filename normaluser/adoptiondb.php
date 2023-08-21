
<?php
include "../globalfiles/config.php";
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
    header("Location: lognregister.php");
    exit;
} else {
    $username = $_SESSION['user_id'];
}

// if (isset($_SESSION['adoption_success_message'])) {
//     echo '<script>alert("' . $_SESSION['adoption_success_message'] . '");</script>';
//     unset($_SESSION['adoption_success_message']);
// }

if (isset($_SESSION['alert_message'])) {
    echo '<script>alert("' . $_SESSION['alert_message'] . '");</script>';
    unset($_SESSION['alert_message']);
    echo '<script>window.location.href = "index.php#wishlist";</script>';
}

if (isset($_POST['Addtocart'])) {
    $A_name = $_POST['Ani_name'];
    $A_image = $_POST['Ani_image'];

    $select_cart = mysqli_query($conn, "SELECT * FROM `addedtocart` WHERE title = '$A_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($select_cart) > 0) {
        $_SESSION['alert_message'] = "Already added to Wishlist!!";
    } else {
        mysqli_query($conn, "INSERT INTO `addedtocart`(user_id, title, description) VALUES('$user_id', '$A_name', '$A_image')") or die('query failed');
        $_SESSION['alert_message'] = "Added to wishlist";
    }

    header("Location: index.php#wishlist");
    exit;
}

if (isset($_POST['Adoptnow'])) {
$Ani_name = $_POST['Ani_name'];
$Ani_image = $_POST['Ani_image'];
    
$availability_query = "SELECT * FROM availablepets WHERE title = '$Ani_name'";
$availability_result = mysqli_query($conn, $availability_query);
    if (mysqli_num_rows($availability_result) > 0) {
            $sql = "INSERT INTO `adoptedpets` (`title`, `description`) VALUES ('$Ani_name', '$Ani_image')";
            $result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error adopting pet: " . mysqli_error($conn);
    exit;
}

$adoption_id = mysqli_insert_id($conn);
    $remove_query = "DELETE FROM `addedtocart` WHERE user_id = '$user_id' AND title = '$Ani_name'";
    $remove_result = mysqli_query($conn, $remove_query);

    if (!$remove_result) {
        echo "Error removing pet from wishlist: " . mysqli_error($conn);
        exit;
    }

 // Create the SELECT query
// $query = "SELECT sno, title, details FROM availablepets";

// // Execute the query
// $result = $conn->query($query);

// if (!$result) {
//     echo "Error retrieving available pets: " . mysqli_error($conn);
//     exit;
// }

// // Check if the query was successful
// if ($result->num_rows > 0) {
//     // Create an associative array to store the file paths
//     $file_paths = array();

//     // Fetch the data
//     while ($row = $result->fetch_assoc()) {
//         // Access the column values
//         $title = $row['title'];
//         $details = $row['details'];
//         $sno = $row['sno'];

//         // Extract file name without extension
//         $titleWithoutExtension = pathinfo($title, PATHINFO_FILENAME);
//         $detailsFileName = basename($details);
//         $detailsWithoutExtension = pathinfo($detailsFileName, PATHINFO_FILENAME);

//         // Construct the full file path
//         $file_path = realpath(dirname($details) . '/' . $detailsWithoutExtension . '.txt');

//         // Store the file path in the associative array using the adoption ID as the key
//         $file_paths[$adoption_id] = $file_path;
//     }

//     // Create the DELETE query
//     $delete_query = "DELETE FROM availablepets WHERE title = '$Ani_name'";

//     // Execute the DELETE query
//     $delete_result = $conn->query($delete_query);

//     if (!$delete_result) {
//         echo "Error deleting pet: " . mysqli_error($conn);
//         exit;
//     }

//     // Check if the adoption ID exists in the file paths array
//     if (isset($file_paths[$adoption_id])) {
//         $file_path = $file_paths[$adoption_id];

//         // Store the file path in a session variable
//         $_SESSION['file_path'][$adoption_id] = $file_path;

//         header("Location: download.php?adoption_id=$adoption_id");
//         exit;
//     } else {
//         echo 'File path not found.';
//         exit;
//     }
// } else {
//     echo "No records found.";
//     exit;
// }
     
            // Create the DELETE query
            $delete_query = "DELETE FROM availablepets WHERE title = '$Ani_name'";

            // Execute the DELETE query
            $delete_result = $conn->query($delete_query);

            if (!$delete_result) {
                echo "Error deleting pet: " . mysqli_error($conn);
                exit;
            }else{
                $_SESSION['adoption_success_message'] = "Congratulations! You have successfully adopted $Ani_name.";     
               header("Location: index.php?adoption_success=true");
                exit;
            }
    }else{
        $_SESSION['alert_message'] = "Sorry!!The animal you are trying to adopt is no longer available.";
        header("Location: index.php#adopt");
        exit;
    }

}
?>


<!-- // /*
//  include "../globalfiles/config.php";
//  session_start();
//  $user_id = $_SESSION['user_id'];

//  if (!isset($_SESSION['user_id'])) {
//     header("Location: lognregister.php");
//  } else {
//     $username = $_SESSION['user_id'];
//  }

//  if(isset($_POST['Addtocart'])){
//         $A_name = $_POST['Ani_name'];
//          $A_image = $_POST['Ani_image'];

//         $select_cart = mysqli_query($conn, "SELECT * FROM `addedtocart` WHERE title = '$A_name' AND user_id = '$user_id'") or die('query failed');

//         if(mysqli_num_rows($select_cart) > 0){
//             $_SESSION['alert_message'] = "Already added to Wishlist!!";
//         }else{
//          mysqli_query($conn, "INSERT INTO `addedtocart`(user_id, title, description) VALUES('$user_id', '$A_name', '$A_image')") or die('query failed');
//          $_SESSION['alert_message'] = "Added to wishlist";
//         }
//      header("Location: index.php");
//      exit; 
//     }else{
//               $Ani_name = $_POST['Ani_name'];
//            $Ani_image = $_POST['Ani_image'];

//            $sql = "INSERT INTO `adoptedpets` (`title`, `description`) VALUES ('$Ani_name', '$Ani_image')";
//           $result = mysqli_query($conn, $sql);

//          // Create the SELECT query
//           $query = "SELECT sno, title, details FROM availablepets";

//           // Execute the query
//          $result = $conn->query($query);

//          // Check if the query was successful
//          if ($result && $result->num_rows > 0) {
//            // Fetch the data
//           while ($row = $result->fetch_assoc()) {
//              // Access the column values
//               $title = $row['title'];
//              $details = $row['details'];
//              $sno = $row['sno'];
        
//              // Extract file name without extension
//              $titleWithoutExtension = pathinfo($title, PATHINFO_FILENAME);
//              $detailsFileName = basename($details);
//              $detailsWithoutExtension = pathinfo($detailsFileName, PATHINFO_FILENAME);
        
//              // Construct the full file path
//              $file_path = dirname($details) . '/' . $detailsWithoutExtension . '.txt';
//             }
//          }else{
//                 echo "No records found.";
//             }

//          // Create the DELETE query
//          $query = "DELETE FROM availablepets WHERE sno=$sno";


//          // Execute the query
//          if ($conn->query($query) === TRUE) {
//          echo "Row deleted successfully.";
//          } else {
//          echo "Error deleting row: " . $conn->error;
//          }


//          // Check if the file exists
//          if (file_exists($file_path)) {
//          // Set the headers to force download
//          header('Content-Description: File Transfer');
//          header('Content-Type: application/octet-stream');
//          header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
//          header('Expires: 0');
//          header('Cache-Control: must-revalidate');
//          header('Pragma: public');
//          header('Content-Length: ' . filesize($file_path));

//           // Read the file and output its contents
//          readfile($file_path);
//          echo $file_path."yayaya";
//          // exit;
//          } else {
//          // File doesn't exist, display an error message or redirect
//            echo 'File not found.';
//           }
         
 
 
//         //  header("Location:index.php");
//            exit;
//         }
 
// 
 -->
