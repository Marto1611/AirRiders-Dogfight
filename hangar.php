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
        $i=0;
        while($row1 = mysql_fetch_row($query1)) {
            $aircraftID = $row1[0];
            $query2 = mysql_query("SELECT * FROM `aircraft` WHERE AircraftID='$aircraftID'") or die(mysql_error());
            $query3 = mysql_query("SELECT Aircraft FROM `players` WHERE Username='$player'") or die(mysql_error());
            $selectedAircraft = mysql_fetch_row($query3);
            while ($row = mysql_fetch_assoc($query2)) {
                $i++;
                ?>
                <div class="firstChoose">
                    <h1><?php echo $row['Model']; ?></h1>
                    <hr>
                    <img src="css/images/Aircraft/<?php echo $row['AircraftID']; ?>.jpg" width="200" height="150"/>
                    <hr>
                    <h1>Ammunition</h1>
                    <p style="margin-top: 5px;">Rocket Ammo: <span style="color: #00334d; font-weight: bold; font-size: 20px;"><?php echo MissileAmmo($player); ?></span> pcs</p>
                    <p style="margin-top: 5px;">Guns Ammo: <span style="color: #00334d; font-weight: bold; font-size: 20px;" ><?php echo GunsAmmo($player); ?></span> pcs</p>
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
                    <?php if($selectedAircraft[0] == $row['AircraftID']) {?>
                    <button disabled style="opacity: 1; color: black; background-color: darkgoldenrod">Selected</button>
                    <?php } else { ?>
                        <form method="post" action="selectAircraft.php" id="<?php echo $i; ?>">
                            <input value="<?php echo $row['AircraftID']; ?>" type="hidden" name="Aircraft"/>
                            <button value="<?php echo $row['AircraftID']?>">Select</button>
                            </form>
                        <script type="text/javascript">
                            function SelectF<?php echo $i; ?>()
                            {
                                document.getElementById("<?php echo $i; ?>").submit();
                            }
                            $("#<?php echo $i; ?>").submit(function(event) {
                                event.preventDefault();
                                alertify.confirm('Confirm Selection', 'Are you sure you want to select this aircraft as primary ?', function(){ alertify.success('Confirmed Selection!',5,SelectF<?php echo $i; ?>()) }
                                    , function(){ alertify.error('Selection declined')}).set('labels', {ok: "Confirm", cancel: "Decline"});
                            });
                        </script>
                    <?php } ?>
                </div>
                <?php
            }
        }
}
    ?>

    <!DOCTYPE html >
    <html lang = "en" id="myHangar">
    <head >
        <script src="alertifyjs/jquery-3.1.0.min.js"></script>
        <script src="alertifyjs/alertify.min.js"></script>
        <!-- include the style -->
        <link rel="stylesheet" href="alertifyjs/css/alertify.min.css" />
        <!-- include a theme -->
        <link rel="stylesheet" href="alertifyjs/themes/default.css" />
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
                <a href="missions.php"><li></li>Missions</li></a>
                <a href="hangar.php"><li>Hangar</li></a>
                <a href="supplies.php"><li>Supplies</li></a>
                <li><h1 style="margin-top: 5px;"><?php echo Cash($player); ?><img src="css/images/icons/coin.svg" width="40px" height="30px"/></h1></li>
                <li><h1 style="font-size: 30px;">Level <?php echo Level($player); ?><br><hr style="margin: 0px; height: 8px; background: darkgoldenrod; width: <?php echo CurrXP($player); ?>%;"/></h1></li>
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
