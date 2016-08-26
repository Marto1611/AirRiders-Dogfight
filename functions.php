<?php
function Cash($player)
{
    $cashQuery=mysql_query("SELECT Cash FROM `players` WHERE Username='$player'") or die(mysql_error());
    if(mysql_num_rows($cashQuery) == 1)
    {
        $cash = mysql_fetch_row($cashQuery);
        return $cash[0];
    }
}
function Owned($player) {
    $ownedQuery=mysql_query("SELECT Aircraft FROM `players` WHERE Username='$player'") or die(mysql_error());
    if(mysql_num_rows($ownedQuery) == 1)
    {
        $ownedAircraft = mysql_fetch_row($ownedQuery);
        return $ownedAircraft[0];
    }

}
function Level($player) {
    $levelQuery=mysql_query("SELECT Level FROM `players` WHERE Username='$player'") or die(mysql_error());
    if(mysql_num_rows($levelQuery) == 1)
    {
        $level = mysql_fetch_row($levelQuery);
        return $level[0];
    }
}
function CurrXP($player) {
    $xp=mysql_query("SELECT CurrXP FROM `players` WHERE Username='$player'") or die(mysql_error());
    if(mysql_num_rows($xp) == 1)
    {
        $currXp = mysql_fetch_row($xp);
        return $currXp[0];
    }
}
function MissileAmmo($player) {
    $ra=mysql_query("SELECT rAmmo FROM `players` WHERE Username='$player'") or die(mysql_error());
    if(mysql_num_rows($ra) == 1)
    {
        $rAmmo = mysql_fetch_row($ra);
        return $rAmmo[0];
    }
}
function GunsAmmo($player) {
    $ga=mysql_query("SELECT gAmmo FROM `players` WHERE Username='$player'") or die(mysql_error());
    if(mysql_num_rows($ga) == 1)
    {
        $gAmmo = mysql_fetch_row($ga);
        return $gAmmo[0];
    }
}
function OwnedCycle($player)
{
    $ownedQuery2=mysql_query("SELECT ItemID FROM purchases WHERE Username='$player' AND Type='aircraft'") or die(mysql_error());
    while($row = mysql_fetch_assoc($ownedQuery2))
    {
        $values[] = $row['ItemID'];
    }
    return $values;
}

function transBegin()
{
    mysql_query("BEGIN");
}
function transCommit()
{
    mysql_query("COMMIT");
}
function transRollback() {
    mysql_query("ROLLBACK");
}
function CurrMission($player)
{
    $MissionQuery=mysql_query("SELECT player FROM player_mission WHERE player='$player'") or die(mysql_error());
    if(mysql_fetch_row($MissionQuery) > 0)
    {
        return true;
    }
    else return false;
}
