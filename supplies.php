<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 26.08.2016 г.
 * Time: 10:30
 */
include "config.php";
include "functions.php";

if(isset($_SESSION['username'])) {
    $player = $_SESSION['username'];
            ?>

    <!DOCTYPE html >
    <html lang = "en" id="supplies">
    <head >
        <script type="text/javascript">
            <?php if($_SESSION["ammoCrate"] == 1)  { ?>
            document.addEventListener('DOMContentLoaded', function() {
                alertify.success('Purchase successful! Guns Ammo Crate has been added to your inventory !',5);
            }, false);
            <?php $_SESSION["ammoCrate"] = 0; }?>

            <?php if($_SESSION["missile"] == 1)  { ?>
            document.addEventListener('DOMContentLoaded', function() {
                alertify.success('Purchase successful! AIM-9x Missile has been added to your inventory !',5);
            }, false);
            <?php $_SESSION["missile"] = 0; }?>
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

        <div class="ammoBox">
            <form method="post" action="suppliesPurchase.php" id="1">
            <h1>Guns Ammo Crate</h1>
                <hr>
                <img src="css/images/gunsAmmo.png" width="240px" height="150px" />
                <hr>
                <h1>Qty: <u>400</u></h1>
                <hr>
                <h1>Price: 0.5<img src="css/images/icons/coin.svg" width="40px" height="30px"/></h1>
                <hr>
                <input name="ammo" type="hidden" value="1"/>
				<?php if(Cash($_SESSION["username"]) >= 0.5) { ?>
                <button>Buy</button>
                <?php } else { ?>
                    <button disabled>Not enough Coins</button>
                <?php } ?>
            </form>
        </div>
        <div class="ammoBox">
            <form method="post" action="suppliesPurchase.php" id="2">
            <h1>AIM-9x Missile</h1>
                <hr>
                <img src="css/images/missileAmmo.png" width="240px" height="150px" />
                <hr>
                <h1>Qty: <u>1</u></h1>
                <hr>
                <h1>Price: 3<img src="css/images/icons/coin.svg" width="40px" height="30px"/></h1>
                <hr>
                <input name="ammo" type="hidden" value="2"/>
                <?php if(Cash($_SESSION["username"]) >= 3) { ?>
                <button>Buy</button>
                <?php } else { ?>
                    <button disabled>Not enough Coins</button>
                <?php } ?>
            </form>
        </div>
        <div class="ammoBox">
            <h1>Ammo Inventory</h1>
            <hr>
            <h1>Guns Ammo QTY: <u style="color: darkgoldenrod;"><?php echo GunsAmmo($_SESSION["username"]); ?></u></h1>
            <h1>Missiles: <u style="color: darkgoldenrod;"><?php echo MissileAmmo($_SESSION["username"]); ?></u></h1>
        </div>
        <script type="text/javascript">
            function SubmitF1()
            {
                setTimeout(function(){ document.getElementById("1").submit() },1000);
            }
            $("#1").submit(function(event) {
                event.preventDefault();
                alertify.confirm('Confirm Purchase', 'Are you sure you want to purchase 1 Guns Ammo Crate ?', function(){ alertify.success('Confirming purchase \n Please wait.....',3,SubmitF1()) }
                    , function(){ alertify.error('Purchase declined')}).set('labels', {ok: "Confirm", cancel: "Decline"});
            });

            function SubmitF2()
            {
                setTimeout(function(){ document.getElementById("2").submit() },1000);
            }
            $("#2").submit(function(event) {
                event.preventDefault();
                alertify.confirm('Confirm Purchase', 'Are you sure you want to purchase 1 AIM-9x Missile ?', function(){ alertify.success('Confirming purchase \n Please wait.....',3,SubmitF2()) }
                    , function(){ alertify.error('Purchase declined')}).set('labels', {ok: "Confirm", cancel: "Decline"});
            });
        </script>
    </main>
    </body >
    </html >

    <?php
} else {
    header("Location: index.html");
}
?>