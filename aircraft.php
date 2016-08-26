<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 21.7.2016 г.
 * Time: 10:30
 */
include "config.php";
include "functions.php";

if(isset($_SESSION['username'])) {
    $player = $_SESSION['username'];

    function PlayerAircraft()
    {
        $query2 = mysql_query("SELECT * FROM `aircraft`") or die(mysql_error());
        $i=0;
        while($row=mysql_fetch_assoc($query2))
        {
            $i++;
            ?>
            <div class="firstChoose">
                <form method="post" action="aircraftPurchase.php" id="<?php echo $i; ?>">
                    <input value="<?php echo $row['AircraftID']; ?>" type="hidden" name="Aircraft"/>
            <h1><?php echo $row['Model']; ?></h1>
            <hr>
            <img src="css/images/Aircraft/<?php echo $row['AircraftID']; ?>.jpg" width="200" height="150" />
            <hr>
                    <h1>Ammunition</h1>
                    <br>
                   <h2><?php echo $row['Ammunition']; ?></h2>
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
            <p style="height: 200px;"><?php echo $row['InfoAboutAircraft']; ?></p>
                <hr>
                <?php
                for($j=0;$j<sizeof(OwnedCycle($_SESSION['username']));$j++) {
                    if (OwnedCycle($_SESSION['username'])[$j] == $row['AircraftID']) {
                        $owned = true;
                        break;
                    } else {
                        $owned = false;
                    }
                }
                if($owned) {
                    ?>
                    <button disabled style="opacity: 1; color: black; background-color: darkgoldenrod;">Owned</button>
                    <?php
                }
                else {
                        if (Cash($_SESSION['username']) > $row['Price']) { ?>
                            <input type="hidden" value="<?php echo $row['Price']; ?>" name="Price"/>
                            <button value="<?php echo $row['Price']; ?>">Purchase <?php echo $row['Price'] ?><img src="css/images/icons/coin.svg" width="40px"
                                                                                                                  height="30px"/></button>
                        <?php } else {
                            ?>
                            <button disabled>Buy <?php echo $row['Price'] ?><img src="css/images/icons/coin.svg"
                                                                                 width="40px" height="30px"/></button>
                            <?php
                        }
                }
            ?>
                    </form>
            </div>
           <script type="text/javascript">
                function SubmitF<?php echo $i; ?>()
                {
                    setTimeout(function(){ document.getElementById("<?php echo $i; ?>").submit() },1000);
                }
                $("#<?php echo $i; ?>").submit(function(event) {
                    event.preventDefault();
                    alertify.confirm('Confirm Purchase', 'Are you sure you want to purchase this aircraft ?', function(){ alertify.success('Confirming purchase \n Please wait.....',3,SubmitF<?php echo $i; ?>()) }
                        , function(){ alertify.error('Purchase declined')}).set('labels', {ok: "Confirm", cancel: "Decline"});
                });
            </script>
            <?php
        }
    }
    ?>

    <!DOCTYPE html >
    <html lang = "en" id="aircraft">
    <head >
        <script type="text/javascript">
            <?php if($_SESSION["success"] == 1)  { ?>
            document.addEventListener('DOMContentLoaded', function() {
                alertify.success('Purchase successful! You can access your new aircraft from Hangar!',5);
            }, false);
            <?php $_SESSION["success"] = 0; }?>
        </script>
        <script src="alertifyjs/jquery-3.1.0.min.js"></script>
        <script src="alertifyjs/alertify.min.js"></script>
        <!-- include the style -->
        <link rel="stylesheet" href="alertifyjs/css/alertify.min.css" />
        <!-- include a theme -->
        <link rel="stylesheet" href="alertifyjs/themes/default.css" />
        <link rel="shortcut icon" href="css/images/icons/jetIcon.png" type="image/x-icon" />
        <link type = "text/css" rel = "stylesheet" href = "css/profile.css" />
        <meta charset = "UTF-8" >
        <title >Aircraft Hangar</title>
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
            <?php PlayerAircraft(); ?>
    </main>
    </body >
    </html >

    <?php
} else {
    header("Location: index.html");
}
?>
