<?php

include '../globalfiles/config.php';

session_start();

error_reporting(0);

$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
    header("Location: lognregister.php");
} else {
    $username = $_SESSION['user_id'];
}

if (isset($_SESSION['adoption_success_message'])) {
    echo '<script>alert("' . $_SESSION['adoption_success_message'] . '");</script>';
    unset($_SESSION['adoption_success_message']);
}

if (isset($_SESSION['alert_message'])) {
    $alert_message = $_SESSION['alert_message'];
    unset($_SESSION['alert_message']);
    echo "<script>alert('$alert_message')</script>";
}

if (isset($_SESSION['sestime']) && (time() - $_SESSION['sestime'] > 600)) {
    session_unset();
    session_destroy();
    header("Location: lognregister.php");
    exit;
}
$_SESSION['sestime'] = time();


    if (isset($_GET['success'])) {
        echo '<script>
            window.onload = function() {
                alert("Form submitted successfully. Thank you for your submission!");
                window.location.href = "#rescue";
            };
        </script>';
    } elseif (isset($_GET['error'])) {
        $error = $_GET['error'];
        echo '<script>
            window.onload = function() {
                alert("An error occurred: ' . $error . '");
                window.location.href = "#rescue";
            };
        </script>';
    }
    


// if(isset($_POST['Addtocart'])){
//     $Ani_name = $_POST['Ani_name'];
//     $Ani_image = $_POST['Ani_image'];

//     $select_cart = mysqli_query($conn, "SELECT * FROM `addedtocart` WHERE title = '$Ani_name' AND user_id = '$user_id'") or die('query failed');

//    if(mysqli_num_rows($select_cart) > 0){
//     echo "<script>alert('Already added to Wishlist!!')</script>";
//    }else{
//       mysqli_query($conn, "INSERT INTO `addedtocart`(user_id, title, description) VALUES('$user_id', '$Ani_name', '$Ani_image')") or die('query failed');
//       echo "<script>alert('Added to wishlist')</script>";
//    }

// };

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `addedtocart` WHERE id = '$remove_id'") or die('query failed');
    header('location:index.php#wishlist');
 }

 if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `addedtocart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:index.php#wishlist');
 }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet-Adopt</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

    <!-- header section starts      -->

    <header>

        <a href="#" class="logo"><i class="fas fa-dog"></i>Animal adoptation</a>

        <nav class="navbar">
            <a class="active" href="#home">home</a>
            <a href="#pets">pets</a>
            <a href="#about">about</a>
            <a href="#adopt">adopt</a>
            <a href="#wishlist">Wishlist</a>
            <a href="#rescue">rescue</a>
            <a href="#review">review</a>
            <!-- <a href="#contact">Contact Us</a> -->

            </div>
        </nav>

        <div class="icons">
            <i class="fas fa-bars" id="menu-bars"></i>
            <?php
                $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select_user) > 0){
                    $fetch_user = mysqli_fetch_assoc($select_user);
                };
            ?>
            <a id="profileName" href="#"><?php echo $fetch_user['username']; ?> </a>
            <a href="../globalfiles/logout.php">logout</a>
        </div>
        <!-- <div class="icons">
            <a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true" name="cart"></i></a>
        </div> -->
    </header>

    <!-- header section ends-->

    <!-- search form  -->

    <!-- <form action="" id="search-form">
        <input type="search" placeholder="search here..." name="" id="search-box">
        <label for="search-box" class="fas fa-search"></label>
        <i class="fas fa-times" id="close"></i>
    </form> -->

    <!-- home section starts  -->

    <section class="home" id="home">

        <div class="swiper-container home-slider">

            <div class="swiper-wrapper wrapper">

                <div class="swiper-slide slide">
                    <div class="content">
                        <span>our special pet</span>
                        <h3>Max</h3>
                        <p>"If you're looking for a loyal and loving companion, Max is the dog for you. He has so much love to give and is ready to be adopted into his forever home. Come meet Max today and see if he's the perfect match for you!"</p>
                        <a href="#adopt" class="btn">adopt now</a>
                    </div>
                    <div class="image">
                        <img src="../images/dog_PNG135.png" alt="">
                    </div>
                </div>

                <!-- <div class="swiper-slide slide">
                <div class="content">
                    <span>our special pet</span>
                    <h3>Adorable pet</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit natus dolor cumque?</p>
                    <a href="#" class="btn">adopt now</a>
                </div>
                <div class="image">
                    <img src="../images/cute-dog-png-hd-puppy-png-hd-pluspng-com-964-puppy-png-hd-964.png" alt="">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>our special pet</span>
                    <h3>Lovely Pet</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit natus dolor cumque?</p>
                    <a href="#" class="btn">adopt now</a>
                </div>
                <div class="image">
                    <img src="../images/dog_PNG50302.png" alt="">
                </div>
            </div> -->

            </div>

            <div class="swiper-pagination"></div>

        </div>

    </section>

    <!-- home section ends -->

    <!-- pets section starts  -->

    <section class="pets" id="pets">

        <h3 class="sub-heading"> our pets </h3>
        <h1 class="heading"> Adopted pets </h1>

        <div class="box-container">
            <?php
            $sql = "SELECT * FROM `adoptedpets`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {?>

                <div class="box" style="padding:10px;">
                    <img src="../uploads/<?= $row['description']?>">
                   <p class='btn' style='display:flex; justify-content:center;'><?= $row['title'] ?> </p>
                </div>

                <?php }


            ?>

            </div>

        </div>

    </section>

    <!-- pets section ends -->

    <!-- about section starts  -->

    <section class="about" id="about">

        <h3 class="sub-heading"> about us </h3>
        <h1 class="heading"> why choose us? </h1>

        <div class="row">

            <div class="image">
                <img src="../images/pexels-helena-lopes-2253275.jpg" alt="">
            </div>

            <div class="content">
                <h3>best rescue service in the country</h3>
                <p>we are dedicated to finding loving forever homes for our animals. We take pride in providing the highest level of care to all of our animals, ensuring they receive proper medical attention, nutrition, and love.</p>
                <p>Our team is passionate about animal welfare and works tirelessly to make sure each animal is placed in a safe and happy home. When you adopt from us, you can trust that you are adopting a healthy and well-cared-for pet.</p>

                <a href="https://www.petfinder.com/adopt-or-get-involved/about-petfinder/our-mission/" target="_blank" class="btn">learn more</a>
            </div>

        </div>

    </section>

    <!-- about section ends -->

    <!-- available section starts  -->

    <section class="adopt" id="adopt">

        <h3 class="sub-heading"> Pets available </h3>
        <h1 class="heading"> available pets </h1>
        <div class="box-container">

            <?php
            $sql = "SELECT * FROM `availablepets`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {?>

            <div class="box" style="padding:10px;">
                <form method ="post" action="adoptiondb.php">
                    <img src="../uploads/<?= $row['description']?>">
                    <input type="hidden" name="Ani_name" value="<?php echo $row['title']; ?>">
                    <input type="hidden" name="Ani_image" value="<?php echo $row['description']; ?>">
                    <div class="buttons">

                        <h3 style="display:flex; justify-content:center;"><?= $row['title'] ?> </h3>
                        <a class="view-more-link" href="ani_details.php?sno=<?php echo $row['sno']; ?>">View More</a>
                         <!-- <input type="submit" name="Adoptnow" class="option-btn" value="Adopt" > -->
                         <button name="Addtocart"><i class="fa fa-heart"></i></button>
                    </div>
                </form>
                <!-- <form action="" method="post">
                 <button class="btn" name="Addtocart">cart</button>
                </form> -->
            </div>

            <?php }


            ?>

        </div>

    </section>


<!-- wishlist section     -->


    <section class="wishlist" id="wishlist">
         <div class="Add-cart">

            <h1 class="heading">Wishlist</h1>

            <table>
                 <thead>
                    <th>S.no</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Actions</th>
                 </thead>
                    <tbody>
                     <?php
                            $cart_query = mysqli_query($conn, "SELECT * FROM `addedtocart` WHERE user_id = '$user_id'") or die('query failed');
                                $sno = 0;
                                    if(mysqli_num_rows($cart_query) > 0){
                                        while($fetch_cart = mysqli_fetch_assoc($cart_query)){
                                            $sno = $sno + 1;
                                          ?>
                                            <tr>
                                                <td><?php echo $sno; ?></td>
                                                <td><img src="../uploads/<?php echo $fetch_cart['description']; ?>" height="100"  alt=""></td>
                                                <td style="font-size:20px;"><?php echo $fetch_cart['title']; ?></td>

                                                <td>
                                                    <button class="button_tabel">
                                                        <div>
                                                            <form action="adoptiondb.php" method="post">
                                                                <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                                                                <input type="hidden" name="Ani_name" value="<?= $fetch_cart['title']; ?>">
                                                                <input type="hidden" name="Ani_image" value="<?= $fetch_cart['description']; ?>">
                                                                <input type="submit" name="Adoptnow" value="Adopt" class="option-btn">
                                                            </form>
                                                        </div>
                                                    </button>  

                                                        <button class="button_tabel">
                                                         <a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('remove item from cart?');">remove</a>
                                                        </button>   
                                                </td>
         
                                             </tr>
                                        <?php }
                                    }else{
                                         echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
                                          }
                            ?>
                        <tr class="table-bottom">
                            <td colspan="4"><a href="index.php?delete_all" onclick="return confirm('delete all from cart?');" class="delete-btn <?php echo ($sno > 1)?'':'disabled'; ?>">delete all</a></td>
                        </tr>
                    </tbody>
                </table>

        </div>
    </section>




    <!-- menu section ends -->

    <!-- rescue section starts  -->

    <section class="rescue" id="rescue">

        <h3 class="sub-heading"> rescue now </h3>
        <h1 class="heading"> free and fast </h1>

        <form action="upload.php" method="post" enctype="multipart/form-data">

            <div class="inputBox">
                <div class="input">
                    <span>your name</span>
                    <input type="text" placeholder="enter your name" id="fullname" class="fullname" name="fullname"
                        required> 
                </div>
                <div class="input">
                    <span>your number</span>
                    <input type="number" placeholder="enter your number" id="number" class="number" name="number"
                        required>
                    <span class="error" style="display:block; color:red;"><?php echo $numerror; ?></span>
                </div>
            </div>
            <div class="inputBox">
                <div class="input">
                    <span>your rescue</span>
                    <input type="text" placeholder="enter pet species" id="breed" class="breed" name="breed" required>
                </div>
                <div class="input">
                    <span>photo</span>
                    <input type="file" placeholder="insert an image" id="my_image" class="my_image" name="my_image"
                        required>
                </div>
            </div>
            <div class="inputBox">
                <div class="input">
                    <span>how much</span>
                    <input type="number" placeholder="how many pets" id="quantity" class="quantity" name="quantity"
                        required>
                </div>
                <div class="input">
                    <span>date and time</span>
                    <input type="datetime-local" id="date" class="date" name="date" required>
                </div>
            </div>
            <div class="inputBox">
                <div class="input">
                    <span>your address</span>
                    <textarea name="address" placeholder="enter your address" id="address" class="address" cols="30"
                        rows="10" required></textarea>
                </div>
                <div class="input">
                    <span>your message</span>
                    <textarea name="message" placeholder="enter your message" id="message" class="message" cols="30"
                        rows="10" required></textarea>
                </div>
            </div>

            <input type="submit" name="rescuesubmit" value="rescue now" class="btn"
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        </form>

    </section>

    <!-- rescue section ends -->

    <!-- review section starts  -->
      <section class="review" id="review">
      <h3 class="sub-heading"> user's review </h3>
        <h1 class="heading"> what they say </h1>
      <div class="Reviews">
      <div class="inner">
        <!-- <h1>Reviews</h1> -->
        <div class="border"></div>

        <div class="row">
          <div class="col">
            <div class="Review">
              <img src="../images/gopal.png" alt="">
              <div class="name">Gopal Singh</div>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
                <div class="pborder">
                <p>
                Your site's cleanliness and ease of navigation are commendable. It's a breeze to explore and find the information I need. Well done!
                </p>
                </div>
              
            </div>
          </div>

          <div class="col">
            <div class="Review">
              <img src="../images/momin.png" alt="">
              <div class="name">Momin moogaar</div>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
              </div>
                <div class="pborder">
                <p>
              I'm impressed with the genuine animal service provided on your site. The care and attention to animals' well-being is commendable!!
              </p>
                </div>
              
            </div>
          </div>

          <div class="col">
            <div class="Review">
              <img src="../images/sohin.png" alt="">
              <div class="name">Sohin maajduur</div>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
              </div>
              <div class="pborder">
              <p>
              Your fast rescue and adoption service is remarkable! The speed and efficiency in finding loving homes for animals in need is truly admirable.
              </p>
              </div>                     
              
            </div>
          </div>
        </div>
      </div>
    </div>
      </section>                                    



    <!-- <section class="review" id="review">

        <h3 class="sub-heading"> user's review </h3>
        <h1 class="heading"> what they say </h1>

        <div class="swiper-container review-slider">

            <div class="swiper-wrapper">
                <div class="swiper-slide slide">
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <img src="../images/gopal.png" alt="">
                        <div class="user-info">
                            <h3>Gopal Leo</h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p>I recently had the pleasure of visiting this animal rescue site, and I must say I was thoroughly impressed with what I saw. The site's layout is clean and easy to navigate, which is important when you're looking for information about adopting an animal or supporting the organization in other ways.</p>
                </div>

            </div>

        </div>

    </section> -->

    <!-- review section ends -->

    <!-- footer section starts  -->

    <section class="footer" id="contact">

        <div class="box-container">

            

            <div class="box">
                <h3>quick links</h3>
                <a href="#home">home</a>
                <a href="#pets">pets</a>
                <a href="#about">about</a>
                <a href="#adopt">adopt</a>
                <a href="#wishlist">Wishlist</a>
                <a href="#rescue">rescue</a>
                <a href="#review">review</a>
                <!-- <a href="#contact">Contact Us</a> -->
            </div>
            <div class="box">
             <h3>contact info</h3>
             <a href="#">+123-456-7890</a>
             <a href="#">+111-222-3333</a>
             <a href="#">shahilkeshari2019@gmail.com</a>
             <a href="#">Damnbro@gmail.com</a>
             <a href="#">Koteswor, Nepal - 4111424</a>
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="https://www.facebook.com/profile.php?id=100089024453217" target="_blank">facebook</a>
                <a href="https://twitter.com/elonmusk" target="_blank">twitter</a>
                <a href="https://www.instagram.com/shahilkeshari/" target="_blank">instagram</a>
                <a href="#">linkedin</a>
            </div>

            <div class="box">
                <h3>Send Us Feedback</h3>
                <button class="option-btn"><a href="../normaluser/feedback.php">Click Here</a></button>
            </div>

        </div>

        <div class="credit"> copyright @ 2023 by <span>Kesari Production</span> </div>

    </section>

    <script>
        var message = "<?php echo $message; ?>";
        if (message) {
            alert(message);
        }
    </script>
    

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- custom js file link  -->
    <script src="../js/script.js"></script>

</body>

</html>