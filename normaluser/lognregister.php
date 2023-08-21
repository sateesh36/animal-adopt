<?php 

include '../globalfiles/config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
}
// login code
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['user_id'] = $row['id'];
		header("Location: index.php");
	} else {
		echo "<script>alert('Woops! Username or Password is Wrong.')</script>";
	}

}
// signup code
if (isset($_POST['submit2'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
      if (strlen($_POST['password']) >= 6 && preg_match('/[A-Za-z]/', $_POST['password'])) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
                
                
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
            $email = "";
		}
    } else {
        echo "<script>alert('Password must be at least 6 characters long and contain at least one alphabet.')</script>";
        $_POST['password'] = "";
        $_POST['cpassword'] = "";
    }
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
        $_POST['password'] = "";
        $_POST['cpassword'] = "";
	}
    // header("Location: lognregister.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/lognregister.css" />

    <title>Log in & Sign up Form</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form method="POST" class="sign-up-form">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" name="username"
                            value="<?php echo $username; ?>" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password"
                            value="<?php echo $_POST['password']; ?>" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Confirm Password" name="cpassword"
                            value="<?php echo $_POST['cpassword']; ?>" required>
                    </div>
                    <button type="submit" name="submit2" class="btn">Register</button>
                    <p class="social-text">Or Sign up with social platforms</p>
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
                    </div>
                </form>
                <form method="POST" class="sign-in-form">
                    <h2 class="title">Log in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" name="username" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <button name="login" class="btn">Login</button>
                    <a href="../adminuser/adminlogin.php" class="social-text">Admin user?</a>
                    <p class="social-text">Or Log in with social platforms</p>
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
                    </div>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Wanna Join Us?</h3>
                    <p>
                        You Can Sign Up Here!
                    </p>
                    <button class="btn" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="../images/cat2.png" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Already Signed In?</h3>
                    <p>
                        Come Back!
                    </p>
                    <button class="btn" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="../images/dogu.png" class="image" alt="" />
            </div>
        </div>
    </div>

    <script>
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");

        // Add the 'sign-up-mode' class to set the default mode to signup
        container.classList.add("sign-up-mode");

        sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });

        sign_in_btn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });

        // Email validation function
        function validateEmail(email) {
            // Regular expression for email validation
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Form validation function
        function validateForm() {
            var emailField = document.querySelector('input[name="email"]');
            var email = emailField.value.trim();

            if (email === '') {
                alert('Email is required');
                emailField.focus();
                return false;
            } else if (!validateEmail(email)) {
                alert('Invalid email format');
                emailField.focus();
                return false;
            }

            return true;
        }
    </script>
</body>



</html>