<?php
include 'trashconfig.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="rescue" id="rescue">

<h3 class="sub-heading"> adopt now </h3>
<h1 class="heading"> free and fast </h1>

<form action="trash2.php" method="post" enctype="multipart/form-data">

    <div class="inputBox">
        <div class="input">
            <span>your name</span>
            <input type="text" placeholder="enter your name" id="fullname" class="fullname"  name="fullname">
        </div>
        <div class="input">
            <span>your number</span>
            <input type="number" placeholder="enter your number" id="number" class="number" name="number">
        </div>
    </div>
    <div class="inputBox">
        <div class="input">
            <span>your rescue</span>
            <input type="text" placeholder="enter pet species" id="breed" class="breed"  name="breed">
        </div>
        <div class="input">
            <span>photo</span>
            <input type="file" placeholder="insert an image" id="my_image" class="my_image"  name="my_image">
        </div>
    </div>
    <div class="inputBox">
        <div class="input">
            <span>how much</span>
            <input type="number" placeholder="how many pets" id="quantity" class="quantity" name="quantity">
        </div>
        <div class="input">
            <span>date and time</span>
            <input type="datetime-local" id="date" class="date" name="date">
        </div>
    </div>
    <div class="inputBox">
        <div class="input">
            <span>your address</span>
            <textarea name="address" placeholder="enter your address" id="address" class="address" cols="30" rows="10"></textarea>
        </div>
        <div class="input">
            <span>your message</span>
            <textarea name="message" placeholder="enter your message" id="message" class="message" cols="30" rows="10"></textarea>
        </div>
    </div>

    <input type="submit" name="rescuesubmit" value="rescue now" class="btn">

</form>

</section>

</body>
</html>