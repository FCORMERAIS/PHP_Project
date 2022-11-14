<?php
function testValueUser(string $db,string $serverName,string $table,string $value) : bool 
{
    $mysqli = new mysqli($serverName, "root", "", $db);
    $result = $mysqli->query("SELECT * FROM user WHERE $table = '$value'");
    $mysqli->close();
    if ($result->num_rows == 0) {return false;}
    return true;
}
?>