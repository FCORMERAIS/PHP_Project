<?php
function testValueUser(string $db,string $serverName,string $table,string $value) : bool 
{
    $mysqli = new mysqli($serverName, "root", "", $db);
    $result = $mysqli->query("SELECT * FROM user WHERE $table = '$value'");
    $mysqli->close();
    if ($result->num_rows == 0) {return false;}
    return true;
}

function testValuePassword(string $db,string $serverName,string $table,string $value, string $Nickname) {
    $mysqli = new mysqli($serverName, "root", "", $db);
    $result = $mysqli->query("SELECT Password FROM user WHERE $table = '$Nickname'");
    $mysqli->close();
    if ($result->num_rows == 0) {return false;}
    return($result->fetch_assoc()['Password'] == $value);
}
?>