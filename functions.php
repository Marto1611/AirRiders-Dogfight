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
?>