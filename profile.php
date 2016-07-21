<?php
include "config.php";
// First login profile page
$user = $_SESSION['username'];
$fLog_query = mysql_query("SELECT Aircraft FROM players WHERE Username='$user'") or die(mysql_error());

if(mysql_num_rows($fLog_query) == 1)
{
    $ARCF = mysql_fetch_row($fLog_query);
    if($ARCF[0]==null || $ARCF[0]==0)
    {
        header("Location: firstLogin.php");
    }
    else
    {

    }

}
else{
    header("Location: login.php?logErr=1");
}



// Basic profile page
if(isset($_SESSION['username'])) {
   $player = $_SESSION['username'];
    if($_SESSION['login'] == true)
    {
        ?>
        <audio src="welcome.mp3" controller="false" autoplay></audio>
        <?php
        $_SESSION['login'] = false;
    }

    function PlayerAircraft($player)
    {
        $query=mysql_query("SELECT Aircraft FROM `players` WHERE Username='$player'") or die(mysql_error());
        if(mysql_num_rows($query) == 1)
        {
            $aircraftInfo = mysql_fetch_row($query);
        }
        $query2 = mysql_query("SELECT * FROM `aircraft` WHERE AircraftID='$aircraftInfo[0]'") or die(mysql_error());
        while($row=mysql_fetch_assoc($query2))
        {
            ?>
            <h1><?php echo $row['Model']; ?></h1>
            <hr>
            <img src="css/images/Aircraft/<?php echo $row['AircraftID']; ?>.jpg" width="200" height="150" />
            <hr>
            <h1>Specifications</h1>
            <br>
            <div class="statistics">
            <p>Attack:</p><hr style="width: <?php echo $row['Armor']; ?>px; display: inline-flex; background: darkred; height: 8px;"><br>
             <p>Armor:</p><hr style="width: <?php echo $row['Armor']; ?>px; display: inline-flex; background: darkgoldenrod; height: 8px;">
                <p>Manuverability:</p><hr style="width: <?php echo $row['Manueverability']; ?>px; display: inline-flex; background: darkblue; height: 8px;">
                <p>Max Speed:<?php echo $row['Speed']; ?>km/h</p>
            </div>
            <hr>
            <h1>Produced <?php echo $row['YearOfProduction']; ?></h1>
            <hr>
            <p><?php echo $row['InfoAboutAircraft']; ?></p>
            <?php
        }
    }
    include "functions.php";
    ?>

    <!DOCTYPE html >
<html lang = "en" >
<head >
    <link href="http://allfont.net/allfont.css?fonts=arial-black" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="css/images/icons/jetIcon.png" type="image/x-icon" />
    <link type = "text/css" rel = "stylesheet" href = "css/profile.css" />
    <meta charset = "UTF-8" >
    <title ><?php echo $player; ?>'s Profile</title >
</head >
<body >
<aside class="sidebar">
    <nav>
        <ul>
            <a href="profile.php" id="home"><li></li>Home</l></a>
            <a href="aircraft.php" ><li >Aircraft</li></a>
            <a href="register.html"><li></li>Missions</li></a>
            <a href="hangar.php"><li>Hangar</li></a>
            <a href="register.html"><li>Supplies</li></a>
            <li><h1><?php echo Cash($player); ?><img src="css/images/icons/coin.svg" width="40px" height="30px"/></h1></li>
            <a href="logout.php">Logout</a>
        </ul>
    </nav>
</aside>
<main>
    <div class="playerAircraft">
        <h2>Your Aircraft:</h2>
        <hr>
        <?php PlayerAircraft($player); ?>
    </div>
    <h1 class="welcomeMessage">Welcome back, <?php echo $player; ?></h1>
    <div class="currentMissions">
        <h1>Current Missions:</h1>
        <p id="noCurrentMissions">No current missions</p>
        <hr>
       <h1>Missions Available:</h1>
        <p id="noMissions">No missions currently available</p>
    </div>
</main>
</body >
</html >

    <?php
} else {
    header("Location: login.php");
}
?>