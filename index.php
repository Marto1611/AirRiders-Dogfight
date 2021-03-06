<?php
include "config.php";
include "functions.php";
if(isset($_SESSION["username"])) {
header("Location: profile.php");
} else { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="css/images/icons/jetIcon.png" type="image/x-icon" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <meta charset="UTF-8">
    <title>AirRiders Homepage</title>
</head>
<body>
<audio src="jet.mp3" type="audio/mpeg" controller="false" autoplay></audio>
<h1 class="header">Air Riders-Dogfight</h1>
<main>
    <div class="loginInfo">
        <img src="css/images/homepage_img.jpg" width="400" height="266" />
        <ul class="infoList">
        <li><h1>Buy fighter aircraft</h1></li>
        <li><h1>Collect gold and complete missions</h1></li>
        <li><h1>Conquer the skies as you level up</h1></li>
        <li><h1>Become the best Air Rider !</h1></li>
        </ul>
        <a href="register.php"><button class="login-request-button ">Register now </button></a>
    </div>
<div class="loginWrapper">
    <form method="post" action="login.php">
        <input type="text" value="" placeholder="Email" id="email" name="email"><br>
        <input type="password" value="" placeholder="Password" id="password" name="password"><br>
        <button class="login-request-button">Login</button><br>
    </form>
</div>
    </main>
</body>
</html>
<?php } ?>