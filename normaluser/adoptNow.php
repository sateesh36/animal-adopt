<?php 

include '../globalfiles/config.php';

session_start();

error_reporting(0);

if (!isset($_SESSION['username'])) {
    header("Location: lognregister.php");
}else{
    $username = $_SESSION['username'];
}

if(isset($_SESSION['sestime']) && (time() - $_SESSION['sestime'] > 600)) {
    session_unset(); session_destroy();
    header("Location: lognregister.php");
    exit;
    }
    $_SESSION['sestime'] = time();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ani-Adopt</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
    
<!-- header section starts      -->

<header>

    <a href="#" class="logo"><i class="fas fa-dog"></i>Animal Adoptation</a>

    <nav class="navbar">
        <a class="active" href="#home">home</a>
        <a href="#pets">pets</a>
        <a href="#about">about</a>
        <a href="#adopt">adopt</a>
        <a href="#review">review</a>
        <a href="#rescue">rescue</a>
        
    </div>
    </nav>

    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <a id="profileName" href="#" ><?php echo$username ?> </a>
        <a href="../globalfiles/logout.php">logout</a>
    </div>
</header>

<!-- header section ends-->

<!-- search form  -->

<!-- <form action="" id="search-form">
    <input type="search" placeholder="search here..." name="" id="search-box">
    <label for="search-box" class="fas fa-search"></label>
    <i class="fas fa-times" id="close"></i>
</form> -->


<!-- adopt section starts  -->

<section class="adopt" id="adopt">

    <h3 class="sub-heading"> Pets available </h3>
    <h1 class="heading"> available near you </h1>

    <div class="box-container">

        
    <?php 
    if($_POST['adoptNow']){
        echo "hello ";
        $id = $row['id'];
        
        $sql = "SELECT * FROM `fetching_data` where id =`$id`";
          $result = mysqli_query($conn, $sql);

          while($row = mysqli_fetch_assoc($result)){
            echo "<div class='box'>
                <div class='image'>
                    <img src='../images/$image' >
                </div>
                <div class='content'>
                
                <h3>". $row['name'] . "</h3>
                <p>". $row['descr'] . "</p>
                <a href='adoptNow.php' class='btn'>adopt now</a>
                
                </div>
                </div>";
                
            } 
        }
            ?>

    </div>

</section>

<!-- menu section ends -->


<!-- footer section starts  -->

<section class="footer">

        <div class="box-container">

            

            <div class="box">
                <h3>quick links</h3>
                <a href="#home">home</a>
                <a href="#pets">pets</a>
                <a href="#about">about</a>
                <a href="#adopt">adopt</a>
                <a href="#review">review</a>
                <a href="#rescue">rescue</a>
            </div>
            <div class="box">
            <h3>contact info</h3>
            <a href="#">+123-456-7890</a>
            <a href="#">+111-222-3333</a>
            <a href="#">shahilkesari123@gmail.com.com</a>
            <a href="#">karkibrother@gmail.com</a>
            <a href="#">Bhaktapur, Nepal - 4111424</a>
        </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="#">facebook</a>
                <a href="#">twitter</a>
                <a href="#">instagram</a>
                <a href="#">linkedin</a>
            </div>

        </div>

        <div class="credit"> copyright @ 2023 by <span>Kesari Production</span> </div>

    </section>

<!-- footer section ends -->

<!-- loader part  -->
<!-- <div class="loader-container">
    <img src="../images/loading.gif" alt="">
</div> -->

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="../js/script.js"></script>

</body>
</html>