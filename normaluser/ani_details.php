<?php
include "../globalfiles/config.php";
include "adoptiondb.php";


$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
    header("Location: lognregister.php");
} else {
    $username = $_SESSION['user_id'];
}


if (isset($_GET['sno'])) {
    $sno = $_GET['sno'];

   
    $sql = "SELECT * FROM `availablepets` WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $title = $row['title'];
        $image= $row['description'];
        $species = $row['species'];
        $breed = $row['breed'];
        $age = $row['age'];
        $gender = $row['gender'];
        $weight = $row['weight'];
        $doctor_contact = $row['doctor_contact'];
        $health_condition = $row['health_condition'];
        $owner_contact = $row['owner_contact'];
        

        
        // echo "<h2>$title</h2>";
        // echo "$image";
        // echo "<p>Species: $species</p>";
        // echo "<p>Breed: $breed</p>";
        // echo "<p>Age: $age</p>";
        // echo "<p>Gender: $gender</p>";
        // echo "<p>Weight: $weight</p>";
        // echo "<p>Doctor Contact: $doctor_contact </p>";
        // echo "<p>Health Condition: $health_condition</p>";
        // echo "<p>Owner Contact: $owner_contact</p>";

        
    
    } else {
        echo "Animal not found.";
    }
} else {
    echo "Invalid request.";
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

   
 <!-- <section class="container details my-5 pt-5">
    <div class="row mt-5">
              <div class="col-lg-5 col-md-12 col-12">
                  <img class="img-fluid w-50" src="../uploads/<?= $row['description']?>"/>
                </div>

                <div class="col-md-7">
                    <h2><?php echo $title; ?></h2>
                    <form method="post" action="ani_details.php?sno=<?php echo $sno; ?>">
                        <input type="hidden" name="Ani_name" value="<?php echo $title; ?>">
                        <input type="hidden" name="Ani_image" value="<?php echo $image; ?>">
                        <button type="submit" name="Addtocart">Add to Wishlist</button>
                    </form>
                    
                    <form method="post" action="ani_details.php?sno=<?php echo $sno; ?>">
                        <input type="hidden" name="Ani_name" value="<?php echo $title; ?>">
                        <input type="hidden" name="Ani_image" value="<?php echo $image; ?>">
                        <button type="submit" name="Adoptnow">Adopt Now</button>
                    </form>
                </div>
              

    </div>
</section> -->
<section class="adopt-sec">

    <div class="card-container">
        <div class="card-image">
            <img src="../uploads/<?= $row['description']?>"/>
        </div>
        <div class="animal-detail">
            <p>Name: <?php echo $title; ?></p> 
            <p>Species: <?php echo $species; ?></p> 
            <p>Breed <?php echo $breed; ?></p> 
            <p>Age: <?php echo $age; ?></p> 
            <p>Gender: <?php echo $gender; ?></p> 
            <p>Weight: <?php echo $weight; ?></p> 
            <p>Doctor-info: <?php echo $doctor_contact; ?></p> 
            <p>Health: <?php echo $health_condition; ?></p> 
            <p>Owner: <?php echo $owner_contact; ?></p> 
        </div>
        <div class="btns">

            <form method="post" action="ani_details.php?sno=<?php echo $sno; ?>">
                            <input type="hidden" name="Ani_name" value="<?php echo $title; ?>">
                            <input type="hidden" name="Ani_image" value="<?php echo $image; ?>">
                            <button class="btn adopt" type="submit" name="Adoptnow">Adopt Now</button>
                        </form>
    
                        <form method="post" action="ani_details.php?sno=<?php echo $sno; ?>">
                            <input type="hidden" name="Ani_name" value="<?php echo $title; ?>">
                            <input type="hidden" name="Ani_image" value="<?php echo $image; ?>">
                            <button class="btn wish" type="submit" name="Addtocart">Add to Wishlist</button>
                        </form>
        </div>
    </div>
</section>

            
   
   
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

    
    

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- custom js file link  -->
    <script src="../js/script.js"></script>

</body>

</html>
