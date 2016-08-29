<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 26.8.2016 г.
 * Time: 17:25
 */
include "config.php";
include "functions.php";
$_SESSION["missile"] = 0;
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ammo"])) {
    $ammo = $_POST["ammo"];
    if ($ammo == 1) {
        $newCash = Cash($_SESSION["username"]) - 0.5;
        if ($newCash >= 0) {
            $newGunAmmo = GunsAmmo($_SESSION["username"]) + 400;
            $gaQuery = mysql_query("UPDATE `players` SET gAmmo='$newGunAmmo', Cash='$newCash' WHERE Username='$_SESSION[username]'") or die(mysql_error());
            $_SESSION["ammoCrate"] = 1;
            header("Location: supplies.php");
        }
    }
    if ($ammo == 2) {
        $newCash = Cash($_SESSION["username"]) - 3;
        if ($newCash > 0) {
            $newMissileAmmo = MissileAmmo($_SESSION["username"]) + 1;
            $raQuery = mysql_query("UPDATE `players` SET rAmmo='$newMissileAmmo', Cash='$newCash' WHERE Username='$_SESSION[username]'") or die(mysql_error());
            $_SESSION["missile"] = 1;
            header("Location: supplies.php");
        }
    }
}