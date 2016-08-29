<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 28.8.2016 г.
 * Time: 21:48
 */

include "config.php";
include "functions.php";
if($_SERVER["REQUEST_METHOD"] == "POST") {

        $id = $_POST["missionID"];
        $missionQuery = mysql_query("SELECT * FROM missions WHERE MissionID='$id'") or die(mysql_error());
        while($row=mysql_fetch_assoc($missionQuery))
        {
            $gainedXP = $row["GainedXp"];
            $gainedCoins = $row["GainedCoins"];
            $timeStart = strtotime("now");
            $timeEnd = $timeStart + $row["Time"]*60*60;
            $missionSQ = mysql_query("INSERT INTO `player_mission` SET time_start='$timeStart', time_end='$timeEnd', player='$_SESSION[username]', RewardXP='$gainedXP', RewardCoins='$gainedCoins',MissID='$id'") or die(mysql_error());
            /*       if(strtotime("now") > $timeEnd)
            {

            }
            else {
                $timeLeft = $timeEnd - strtotime("now");
                $timeLeftHrs = (int)($timeLeft/3600);
                $timeLeftMin = ($timeLeft-$timeLeftHrs*3600)/60;
                $timeLeftSec = $timeLeft%60;
                $timeLeftHMS = $timeLeftHrs.":".$timeLeftMin.":".$timeLeftSec;
                echo "<br> Mission in duration. Time left: ".$timeLeftHMS;
            }
     */
            if($row["AmmoType"] == "Guns only")
            {
                $newAmmo = GunsAmmo($_SESSION["username"]) - $row["ReqAmmo"];
                $query=mysql_query("UPDATE `players` SET gAmmo='$newAmmo' WHERE Username='$_SESSION[username]'") or die(mysql_error());
            }
            if($row["AmmoType"] == "Guns, Missiles")
            {
                //TODO
            }
            header("Location: missions.php");
        }

    }