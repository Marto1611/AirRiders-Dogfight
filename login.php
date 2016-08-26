<?php include "config.php";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (!empty($_POST['email'])) {
        $email=test_input($_POST['email']);
    }
    if (!empty($_POST['password'])) {
        $password = test_input(md5($_POST['password']));
    }
    $q = mysql_query("SELECT Username,Email,Password,Level FROM players WHERE Email='$email' AND Password='$password'") or die(mysql_error());
    if(mysql_num_rows($q) == 1)
    {
        $user = mysql_fetch_row($q);
        $_SESSION['login']= true;
        $_SESSION["username"] = $user[0];
        $_SESSION["lvl"] = $user[3];
        header("Location: profile.php");
    }
    else{
        header("Location: login.php?logErr=1");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="css/images/icons/jetIcon.png" type="image/x-icon" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <meta charset="UTF-8">
    <title>AirRiders Homepage</title>
</head>
<body>
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
            <?php if(isset($_GET['logErr']) && $_GET['logErr']==1) { echo "<p class='error'>Wrong email or password \n Please try again !</p>"; } ?>
            <input type="text" value="" placeholder="Email" id="email" name="email"><br>
            <input type="password" value="" placeholder="Password" id="password" name="password"><br>
            <button class="login-request-button">Login</button><br>
        </form>
    </div>
</main>
</body>
</html>
