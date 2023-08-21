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

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $social = $_POST['social'];
    $message = $_POST['message'];

    // Validate email and phone number
    $isValidEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    $isValidPhone = preg_match('/^[0-9]{10}$/', $phone);

    if (!$isValidEmail || !$isValidPhone) {
        if (!$isValidEmail) {
            echo "<script>alert('Invalid email format');</script>";
            echo "<script>document.querySelector('input[name=\"email\"]').value = '';</script>";
        }
        if (!$isValidPhone) {
            echo "<script>alert('Invalid phone number format');</script>";
            echo "<script>document.querySelector('input[name=\"phone\"]').value = '';</script>";
        }
        echo "<script>event.preventDefault();</script>";
    } else {
        // Check if email already exists in the database
        $checkQuery = "SELECT * FROM feedback WHERE email = '$email'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            echo "<script>alert('You have already submitted feedback with this email.');</script>";
        } else {
            // Prepare and execute the SQL query
            $query = "INSERT INTO feedback (name, email, phone, social, message) 
                  VALUES ('$name', '$email', '$phone', '$social', '$message')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Feedback entry successfully inserted
                echo "<script>alert('Thank you for your feedback!');</script>";
                echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 2000);</script>";
            } else {
                // Error in inserting feedback entry
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback page</title>
  <link rel="stylesheet" href="../css/feedbackreg.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
  <div class="wrapper">
    <header>Send Us a Message</header>
    <form action="" method="post">
      <div class="dbl-field">
        <div class="field">
          <input type="text" name="name" placeholder="Enter your name">
          <i class='fas fa-user'></i>
        </div>
        <div class="field">
          <input type="text" name="email" placeholder="Enter your email">
          <i class='fas fa-envelope'></i>
        </div>
      </div>
      <div class="dbl-field">
        <div class="field">
          <input type="text" name="phone" placeholder="Enter your phone">
          <i class='fas fa-phone-alt'></i>
        </div>
        <div class="field">
          <input type="text" name="social" placeholder="Enter your social">
          <i class='fas fa-globe'></i>
        </div>
      </div>
      <div class="message">
        <textarea placeholder="Write your message" name="message"></textarea>
        <i class="material-icons"></i>
      </div>
      <div class="button-area">
        <button type="submit" name="submit">Send Message</button>
        <span></span>
      </div>
    </form>
  </div>

  <script src="../js/script.js"></script>
  

</body>
</html>