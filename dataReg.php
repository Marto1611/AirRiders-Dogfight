<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 19.7.2016 г.
 * Time: 16:47
 */
include "config.php";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST['email'] != $_POST['emailConfirmed'])
    {
        header("Location: register.php?error=4");
    }
    if($_POST['password'] != $_POST['passwordConfirmed'])
    {
        header("Location: register.php?error=3");
    }

    $query = mysql_query("SELECT Username,Email FROM players") or die(mysql_error());
    while ($row = mysql_fetch_row($query))
    {
        if($_POST['email'] == $row[1]) {

            header("Location: register.php?error=2");
        }
        if ($_POST['username'] == $row[0]) {

            header("Location: register.php?error=1");
        }
    }

    $username = test_input($_POST['username']);
    $password = test_input(md5($_POST['password']));
    $email = test_input($_POST['email']);

    $insertQuery = mysql_query("INSERT INTO players SET Username='$username', Password='$password',Email='$email',Cash='3', LVL='1', CurrXP='0'") or die(mysql_error());
    $_SESSION['username'] = $username;
    $_SESSION['login'] = true;
    header("Location: profile.php");
}
?>

