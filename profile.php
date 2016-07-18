<?php
include "config.php";
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
            <h1>Produced <?php echo $row['YearOfProduction']; ?></h1>
            <hr>
            <p><?php echo $row['InfoAboutAircraft']; ?></p>
            <?php
        }
    }
    ?>

    <!DOCTYPE html >
<html lang = "en" >
<head >
    <link type = "text/css" rel = "stylesheet" href = "css/profile.css" />
    <meta charset = "UTF-8" >
    <title > AirRiders Homepage </title >
</head >
<body >
<aside class="sidebar">
    <nav>
        <ul>
            <a href="profile.php" id="home"><li></li>Home</l></a>
            <a href="login.html" ><li >Aircraft</li></a>
            <a href="register.html"><li></li>Missions</li></a>
            <a href="register.html"><li>Messages</li></a>
            <a href="register.html"><li>FAQ</li></a>
            <li><h1>500<img src="css/images/icons/coin.svg" width="40px" height="30px"/></h1></li>
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