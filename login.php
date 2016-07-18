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
    $q = mysql_query("SELECT Username,Email,Password FROM players WHERE Email='$email' AND Password='$password'") or die(mysql_error());
    if(mysql_num_rows($q) == 1)
    {
        $user = mysql_fetch_row($q);
        $_SESSION['login']= true;
        $_SESSION["username"] = $user[0];
        header("Location: profile.php");
    }
    else{
        $message = "<p class='error'>Wrong email or password \n Please try again !</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
        <button class="login-request-button ">Register now </button>
    </div>
    <div class="loginWrapper">
        <form method="post" action="login.php">
            <?php if(isset($message)) echo $message; ?>
            <input type="text" value="" placeholder="Email" id="email" name="email"><br>
            <input type="password" value="" placeholder="Password" id="password" name="password"><br>
            <button class="login-request-button">Login</button><br>
        </form>
    </div>
</main>
</body>
</html>
