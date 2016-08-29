<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 29.8.2016 г.
 * Time: 17:04
 */

include "config.php";
include "functions.php";

$currMissionQuery = mysql_query("SELECT * FROM `player_mission` WHERE player='$_SESSION[username]' AND Completed='0'") or die(mysql_error());
while ($row = mysql_fetch_assoc($currMissionQuery)) {
    if(strtotime("now") >= $row["time_end"] && $row["Completed"] == 0)
    {
        $newCash = Cash($_SESSION["username"]) + $row["RewardCoins"];
        $newXP = CurrXP($_SESSION["username"]) + $row["RewardXP"];
        $rewardsQuery = mysql_query("UPDATE `players` SET Cash='$newCash', CurrXP='$newXP' WHERE Username='$_SESSION[username]'") or die(mysql_error());
        $completed = mysql_query("UPDATE `player_mission` SET Completed=1 WHERE player='$_SESSION[username]'") or die(mysql_error());
    }
    if(strtotime("now") <= $row["time_end"] && $row["Completed"] == 0) {
    $timeLeft = $row["time_end"] - strtotime("now");
    $timeLeftHrs = (int)($timeLeft / 3600);
    $timeLeftMin = (int)(($timeLeft - $timeLeftHrs * 3600) / 60);
    $timeLeftSec = $timeLeft % 60;
    $timeLeftHMS = $timeLeftHrs . " Hrs  " . $timeLeftMin . " Min  " . $timeLeftSec . " Sec";
    echo $timeLeftHMS;
        }
}
