<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 25.08.2016 г.
 * Time: 10:30
 */
include "config.php";
include "functions.php";

if(isset($_SESSION['username'])) {
    $player = $_SESSION['username'];
    function Missions()
    {
        $query2 = mysql_query("SELECT * FROM `missions` WHERE ForLvl='$_SESSION[lvl]'") or die(mysql_error());
        $i=0;
        while($row=mysql_fetch_assoc($query2))
        {
            $i++;
            ?>
            <div class="missionStyle">
                <form method="post" action="startMission.php" id="<?php echo $i; ?>">
                    <input value="<?php echo $row['MissionID']; ?>" type="hidden" name="missionID"/>
                    <h1><?php echo $row['Name']; ?></h1>
                    <hr>
                    <h1>Required Ammo</h1>
                    <p style="font-size: 20px;"><?php echo $row['AmmoType']; echo " - <u>".$row['ReqAmmo']."</u> pcs"; ?></p>
                    <hr>
                    <h1>Mission Briefing</h1>
                    <hr>
                    <div class="briefing">
                    <p style="font-size: 20px"><?php echo $row['Briefing']; ?></p>
                    </div>
                    <hr>
                    <h1>Reward:  <span style="color: darkblue;"><?php echo $row["GainedCoins"]; ?></span><img src="css/images/icons/coin.svg" width="20px" height="15"/> +  <span style="color: darkblue;">XP Points</span></h1>
                    <hr>
                    <h1>Mission Duration: <span style="color: darkblue;"><?php echo (int)$row["Time"]; ?></span> Hrs <span style="color: darkblue;"><?php echo ($row["Time"]-(int)$row["Time"])*60; ?></span> Min</h1>
                    <hr>
                    <?php
                            if(CurrMission($_SESSION["username"])) {
                            if(IsCurrMission($_SESSION["username"]) == $row["MissionID"])
                            {
                        ?>
                                <button disabled style="opacity: 1; color: black; background-color: darkgoldenrod;">Time Left: <div id="timer"></div></button>
                                <?php
                    } else { ?>
                                <button disabled style="opacity: 1; color: black;">You are already on a Mission</button>

                                <?php
                    } } else
                    {
                        if(isMissionCompleted($_SESSION["username"],$row["MissionID"]) == 1)
                        { ?>

                            <button disabled style="opacity: 1; color: black; background-color: darkgoldenrod;">Completed</button>

                     <?php   }
                        else {
                            if ($row['AmmoType'] == "Guns only") {
                                if (GunsAmmo($_SESSION["username"]) >= $row["ReqAmmo"]) {
                                    ?>
                                    <button>Start Mission</button>
                                    <?php
                                } else { ?>
                                    <button disabled style="opacity: 1; color: black;">Not enough Guns Ammo</button>

                                <?php }

                            }
                            if ($row['AmmoType'] == "Guns, Missiles") {

                            }
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
                    alertify.confirm('Mission Start', 'Are you sure you want to start this mission ?', function(){ alertify.success('Mission Confirmed \n Please wait.....',3,SubmitF<?php echo $i; ?>()) }
                        , function(){ alertify.error('Mission declined')}).set('labels', {ok: "Confirm", cancel: "Decline"});
                });
            </script>
            <?php
        }
    }
    ?>

    <!DOCTYPE html >
    <html lang = "en" id="missions">
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
        <title >Aircraft Hangar</title>
        <script type="text/javascript">
            $(document).ready(function(){

                setInterval(function(){
                    $('#timer').load('timer.php');
                },1000);

            });
        </script>
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
        <?php echo Missions(); ?>
        <div class="ammoBox">
            <h1>Ammo Inventory</h1>
            <hr>
            <h1>Guns Ammo QTY: <u style="color: darkgoldenrod;"><?php echo GunsAmmo($_SESSION["username"]); ?></u></h1>
            <h1>Missiles: <u style="color: darkgoldenrod;"><?php echo MissileAmmo($_SESSION["username"]); ?></u></h1>
        </div>
    </main>
    </body >
    </html >

    <?php
} else {
    header("Location: index.html");
}
?>
