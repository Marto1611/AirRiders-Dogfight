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
