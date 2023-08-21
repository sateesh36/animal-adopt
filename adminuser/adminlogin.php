<?php 

include '../globalfiles/config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['admin_name'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $admin_name = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE admin_name='$admin_name' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION['admin_name'] = $row['admin_name'];
      header("Location: index.php");
    } else {
      echo "<script>alert('Woops! Username or Password is Wrong.')</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="../css/lognregister.css" />
    <title>Admin log in form</title>
  </head>
  <body>
    <!-- <div class="container"> -->
      <div class="forms-container">
        <!-- <div class="signin-signup"> -->
          <form method="POST"class="sign-in-form">
            <h2 class="title">Admin</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username"  required>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password"  required>
            </div>
            <button name="submit" class="btn">Login</button>
            <a href="../normaluser/lognregister.php" class="social-text">Go back?</a>
            <!-- <p class="social-text">Or Log in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div> -->
          </form>
          
        </div>
      </div>

      <!-- <div class="panels-container">
        <div class="panel left-panel">
          <img src="../images/dog.png" class="image" alt="" />
        </div>
      </div>
    </div> -->

  </body>
</html>
