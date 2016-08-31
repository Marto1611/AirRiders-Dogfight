<?php
include "config.php";
// First login profile page
$user = $_SESSION['username'];
$fLog_query = mysql_query("SELECT Aircraft,LVL FROM players WHERE Username='$user'") or die(mysql_error());

if(mysql_num_rows($fLog_query) == 1)
{
    $ARCF = mysql_fetch_row($fLog_query);
    if($ARCF[0]==null || $ARCF[0]==0)
    {
        $_SESSION["lvl"] = $ARCF[1];
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
            <h1>Ammunition</h1>
            <p style="margin-top: 5px;">Rocket Ammo: <span style="color: #00334d; font-weight: bold; font-size: 20px;"><?php echo MissileAmmo($player); ?></span> pcs</p>
            <p style="margin-top: 5px;">Guns Ammo: <span style="color: #00334d; font-weight: bold; font-size: 20px;" ><?php echo GunsAmmo($player); ?></span> pcs</p>
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
    <script src="alertifyjs/jquery-3.1.0.min.js"></script>
    <script src="alertifyjs/alertify.min.js"></script>
    <!-- include the style -->
    <link rel="stylesheet" href="alertifyjs/css/alertify.min.css" />
    <!-- include a theme -->
    <link rel="stylesheet" href="alertifyjs/themes/default.css" />
    <link rel="shortcut icon" href="css/images/icons/jetIcon.png" type="image/x-icon" />
    <link type = "text/css" rel = "stylesheet" href = "css/profile.css" />
    <meta charset = "UTF-8" >
    <title ><?php echo $player; ?>'s Profile</title >
    <script type="text/javascript">
        $(document).ready(function(){

            setInterval(function(){
                $('#timer').load('timer.php');
            },1000);

        });
    </script>
</head >
<body >
<aside class="sidebar">
    <nav>
        <ul>
            <a href="profile.php" id="home"><li></li>Home</l></a>
            <a href="aircraft.php" ><li >Aircraft</li></a>
            <a href="missions.php"><li></li>Missions</li></a>
            <a href="hangar.php"><li>Hangar</li></a>
            <a href="supplies.php"><li>Supplies</li></a>
            <li><h1 style="margin-top: 5px;"><?php echo Cash($player); ?><img src="css/images/icons/coin.svg" width="40px" height="30px"/></h1></li>
            <li><h1 style="font-size: 30px;">Level <?php echo Level($player); ?><br><hr style="margin: 0; height: 8px; background: darkgoldenrod; width: <?php echo CurrXP($player); ?>%;"/></h1></li>
            <a href="logout.php">Logout</a>
        </ul>
    </nav>
</aside>
<main>
    <div class="playerAircraft">
        <h2>Selected Aircraft:</h2>
        <hr>
        <?php PlayerAircraft($player); ?>
    </div>
    <h1 class="welcomeMessage">Welcome back, <?php echo $player; ?></h1>
    <div class="currentMissions">
        <h1>Current Missions:</h1>
        <hr>
        <?php if(CurrMission($_SESSION["username"])) {

            echo "<p id='noCurrentMissions' style='font-size: 30px;'><b>".MissionName(IsCurrMission($_SESSION["username"]))."<br>";?>
        <div id="timer" style="color: darkgreen; font-size: 25px; margin-left: 15px; margin-bot: 15px;"><b></b></div>
        <?php } else { ?>
        <p id="noCurrentMissions">No current missions</p>
        <?php echo LevelUp($_SESSION["username"]);
         } ?>
    </div>
</main>
</body >
</html >

    <?php
} else {
    header("Location: login.php");
}
?>