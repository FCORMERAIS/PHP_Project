<?php
function testValueUserMail(string $value) : string 
{
    $sqlQuery = 'SELECT Name FROM user WHERE Mail = :valueName';
    $result = SQLREQUEST($sqlQuery,$value,"fetch");
    return $result["Name"] ?? "";
}

function testValueUserName(string $value) : string 
{
    $sqlQuery = 'SELECT * FROM user WHERE Name = :valueName';
    $result =SQLREQUEST($sqlQuery,$value,"fetch");
    return $result["Name"] ?? "";
}

function testValuePassword(string $value, string $Nickname) : string {
    $sqlQuery = 'SELECT Password FROM user WHERE Name = :Nickname';
    $result = SQLREQUEST($sqlQuery,$Nickname,"fetch");
    return($result['Password'] == $value);
}
?>