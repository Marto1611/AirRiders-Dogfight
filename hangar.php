<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 22.7.2016 г.
 * Time: 1:27
 */
include "config.php";
include "functions.php";

if(isset($_SESSION['username'])) {
    $player = $_SESSION['username'];
    function PlayerAircraft($player)
    {
        $query1 = mysql_query("SELECT ItemID FROM purchases WHERE Username='$player' AND Type='aircraft'") or die(mysql_error());
        while($row1 = mysql_fetch_row($query1)) {
            $aircraftID = $row1[0];
            $query2 = mysql_query("SELECT * FROM `aircraft` WHERE AircraftID='$aircraftID'") or die(mysql_error());
            while ($row = mysql_fetch_assoc($query2)) {
                ?>
                <div class="firstChoose">
                    <h1><?php echo $row['Model']; ?></h1>
                    <hr>
                    <img src="css/images/Aircraft/<?php echo $row['AircraftID']; ?>.jpg" width="200" height="150"/>
                    <hr>
                    <h1>Specifications</h1>
                    <br>
                    <div class="statistics">
                        <p>Attack:</p>
                        <hr style="width: <?php echo $row['Armor']; ?>px; display: inline-flex; background: darkred; height: 8px;">
                        <br>
                        <p>Armor:</p>
                        <hr style="width: <?php echo $row['Armor']; ?>px; display: inline-flex; background: darkgoldenrod; height: 8px;">
                        <p>Manuverability:</p>
                        <hr style="width: <?php echo $row['Manueverability']; ?>px; display: inline-flex; background: darkblue; height: 8px;">
                        <p>Max Speed:<?php echo $row['Speed']; ?>km/h</p>
                    </div>
                    <hr>
                    <h1>Produced <?php echo $row['YearOfProduction']; ?></h1>
                    <hr>
                    <p style="height: 200px;"><?php echo $row['InfoAboutAircraft']; ?></p>
                    <hr>
                    <button disabled style="opacity: 1;">Owned</button>
                </div>
                <?php
            }
        }
}
    ?>

    <!DOCTYPE html >
    <html lang = "en" id="aircraft">
    <head >
        <link href="http://allfont.net/allfont.css?fonts=arial-black" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="css/images/icons/jetIcon.png" type="image/x-icon" />
        <link type = "text/css" rel = "stylesheet" href = "css/profile.css" />
        <meta charset = "UTF-8" >
        <title >My Hangar</title >
    </head >
    <body>
    <aside class="sidebar">
        <nav>
            <ul>
                <a href="profile.php" id="home"><li></li>Home</l></a>
                <a href="aircraft.php" ><li >Aircraft</li></a>
                <a href="register.html"><li></li>Missions</li></a>
                <a href="hangar.php"><li>Hangar</li></a>
                <a href="register.html"><li>Supplies</li></a>
                <li><h1><?php Cash($player); ?><img src="css/images/icons/coin.svg" width="40px" height="30px"/></h1></li>
                <a href="logout.php">Logout</a>
            </ul>
        </nav>
    </aside>
    <main class="aircraftWrap">
        <?php PlayerAircraft($player); ?>
    </main>
    </body >
    </html >

    <?php
    } else {
    header("Location: index.html");
}
?>
