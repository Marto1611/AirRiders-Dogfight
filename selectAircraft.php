<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 24.7.2016 г.
 * Time: 21:35
 */

include "config.php";
require "functions.php";
$username = $_SESSION['username'];
$aircraft = $_POST['Aircraft'];
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $selectQuery = "UPDATE players SET Aircraft='$aircraft' WHERE Username='$username'";
    if(mysql_query($selectQuery) or die(mysql_error())){

        header("Location: hangar.php");
    }
}

