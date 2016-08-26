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
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $newCash = Cash($username) - $_POST['Price'];
    if ($newCash > 0) {
        $purchaseQuery = "INSERT INTO purchases SET Username='$username',ItemID='$aircraft',Type='aircraft'";
        $costQuery = "UPDATE players SET Cash='$newCash' WHERE Username='$username'";

        transBegin();

        $result = mysql_query($purchaseQuery) or die(mysql_error());
        $result1 = mysql_query($costQuery) or die(mysql_error());
        if (!$result || !$result1) {
            transRollback();
            header("Location: aircraft.php");
        } else {
            $_SESSION["success"] = 1;
            transCommit();
            header("Location: aircraft.php");
        }
    }
}
