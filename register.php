<?php
include "dataReg.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="css/images/icons/jetIcon.png" type="image/x-icon" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <meta charset="UTF-8">
    <title>Registration</title>
</head>
<body>
<h1 class="header">Registration Form</h1>
<a href="index.html"><button id="back">Back to homepage</button></a>
<div class="regWrapper">
    <form method="post" action="">
        <?php if(isset($_GET['error'])) {

            if($_GET['error'] == 1)
            {
                echo "<h1>This username is already taken please choose another !</h1>";
            }
            if($_GET['error'] == 2)
            {
                echo "<h1>A user with this email already exists !</h1>";
            }
            if($_GET['error'] == 3)
            {
                echo "<h1>Passwords doesn't match!</h1>";
            }
            if($_GET['error'] == 4)
            {
                echo "<h1>Emails doesn't match!</h1>";
            }


        }
            ?>
        <input type="text" name="username" placeholder="Enter Username" required oninvalid="this.setCustomValidity('A username is required to continue')"
               onchange="this.setCustomValidity('')"/><br />
        <input type="text" name="email" placeholder="Enter your email" required oninvalid="this.setCustomValidity('An email is required to continue')"
               onchange="this.setCustomValidity('')"/><br/>
        <input type="text" name="emailConfirmed" placeholder="Confirm your email" required oninvalid="this.setCustomValidity('Please confirm your email')"
               onchange="this.setCustomValidity('')"/><br/>
        <input type="password" name="password" placeholder="Enter password" required oninvalid="this.setCustomValidity('A password is required to continue')"
               onchange="this.setCustomValidity('')"/><br/>
        <input type="password" name="passwordConfirmed" placeholder="Confirm password" required oninvalid="this.setCustomValidity('Please confirm your password')"
               onchange="this.setCustomValidity('')"/><br/>
        <input type="checkbox" name="acceptRules" value="1" required oninvalid="this.setCustomValidity('You must accept the terms and conditions to finish your registration')"
               onchange="this.setCustomValidity('')">I have read and accept the <a href="#">terms and conditions</a><br>
        <button class="login-request-button">Register</button>
        </form>
</div>
</body>
</html>