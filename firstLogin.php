<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 19.7.2016 г.
 * Time: 20:03
 */
include "config.php";
include "functions.php";
$user = $_SESSION['username'];
$fLog_query = mysql_query("SELECT Aircraft FROM players WHERE Username='$user'") or die(mysql_error());
// inserting selected plane into DB
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['chosen']))
    {
        $chosenAircraft = $_POST['chosen'];
        $insertQuery = "INSERT INTO purchases SET Username='$user', Type='aircraft', ItemID='$chosenAircraft'";
        transBegin();
        $trans=mysql_query($insertQuery) or die(mysql_error());
        if(!$trans)
        {
            transRollback();
        }
        else
        {
            transCommit();
            $updateQuery = mysql_query("UPDATE players SET aircraft='$chosenAircraft' WHERE Username='$user'") or die(mysql_error());
        }
        $_SESSION["login"] = true;
        header("Location: profile.php");
    }
}
// =================================================>

// Choose aircraft algo
if(mysql_num_rows($fLog_query) == 1) {
    $ARCF = mysql_fetch_row($fLog_query);
    if ($ARCF[0] == null || $ARCF[0] == 0) {

        function PlayerAircraft()
        {
            $query2[1] = mysql_query("SELECT * FROM `aircraft` WHERE AircraftID='1'") or die(mysql_error());
            $query2[2] = mysql_query("SELECT * FROM `aircraft` WHERE AircraftID='2'") or die(mysql_error());
            $query2[3] = mysql_query("SELECT * FROM `aircraft` WHERE AircraftID='3'") or die(mysql_error());
            for ($i = 1; $i <= 3; $i++)
          {
              while ($row = mysql_fetch_assoc($query2[$i])) {
                  ?>
                  <div class="firstChoose1">
                      <form method="post" action="">
                  <button name="chosen" value="<?php echo $i; ?>">Choose</button>
                          </form>
                  <hr>
                  <h1><?php echo $row['Model']; ?></h1>
                  <hr>
                  <img src="css/images/Aircraft/<?php echo $row['AircraftID']; ?>.jpg" width="200" height="150"/>
                      <hr>
                      <h1>Ammunition</h1>
                      <br>
                      <h2><?php echo $row['Ammunition']; ?></h2>
                      <hr>
                  <div class="statistics">
                      <p>Attack:</p>
                      <hr style="width: <?php echo $row['Armor']; ?>px; display: inline-flex; background: darkred; height: 8px;">
                      <br>
                      <p>Armor:</p>
                      <hr style="width: <?php echo $row['Armor']; ?>px; display: inline-flex; background: darkgoldenrod; height: 8px;">
                      <p>Manuverability:</p>
                      <hr style="width: <?php echo $row['Manueverability']; ?>px; display: inline-flex; background: darkblue; height: 8px;">
                      <p>Speed:<?php echo $row['Speed']; ?>km/h</p>
                  </div>
                  <hr>
                  <h1>Produced <?php echo $row['YearOfProduction']; ?></h1>
                  <hr>
                  <p><?php echo $row['InfoAboutAircraft']; ?></p>
                  </div>
                  <?php
              }
          }
        }
        // ------------------------------------------------------->
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
            <title ><?php echo $user; ?>'s Profile</title >
			<script>
			$(function() {
			 alertify.confirm('Hello Private !',"Welcome to the world of Dogfighting. AirRiders is the codename of your squad. We fight for freedom and justice and being here means you do the same from now on ! Would you like to go to the Teacher's Room and pass the tutorial ? -Commander",function() { 
			 				 			 alertify.alert('Tutorial',"Hi, Private.Commander sends you huh? I will tell you some things so listen carefully. As an AirRider you must complete missions. Those missions give you coins.To start missions you need supplies like ammo, missiles etc. Be careful though every mission require different ammo! The aircraft tab allows you to buy aircraft from The Military Airforce. Aircrafts are expensive, consider this. The Hangar is your place in the Aviobase. There you can choose which plane you wish to fly. *telephone rings* Opps, looks like I gotta go! You'll figure out the rest. Bye ! - Teacher",function() { 
										 
										 alertify.success('Tutorial has been passed! \nAs a newcomer you are granted a free aircraft. You can choose between the MiG-29, F-16 Fighting Falcon and Saab JAS 39 Gripen. They are not the best, but you are not either. Make your choice Private !',30);
										 }).set('label','Finish Tutorial');
			 
			 }, function() { alertify.error("Tutorial Declined!"); }).set('labels', { ok: 'Start Tutorial', cancel: 'Miss Tutorial' });
			});																				 
			 </script>
        </head >
        <body >
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><h1><?php echo Cash($user); ?><img src="css/images/icons/coin.svg" width="40px" height="30px"/></h1></li>
                    <a href="logout.php">Logout</a>
                </ul>
            </nav>
        </aside>
        <main>
                <?php PlayerAircraft(); ?>
        </main>
        </body >
        </html >

        <?php
    }
    else
    {
        header("Location: profile.php");

    }
}
    ?>