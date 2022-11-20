<?php
function testValueUserMail(string $value) : string 
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery = 'SELECT Name FROM user WHERE Mail = :valueName';
    $verify = $db->prepare($sqlQuery);
    $verify->execute([
        'valueName' => $value,
    ]);
    $result = $verify->fetch();
    echo $result;
    return $result["Name"] ?? "";
}

function testValueUserName(string $value) : string 
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery = 'SELECT * FROM user WHERE Name = :valueName';
    $verify = $db->prepare($sqlQuery);
    $verify->execute([
        'valueName' => $value,
    ]);
    $result = $verify->fetch();
    return $result["Name"] ?? "";
}

function testValuePassword(string $value, string $Nickname) : string {
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery = 'SELECT Password FROM user WHERE Name = :Nickname';
    $verify = $db->prepare($sqlQuery);
    $verify->execute([
        'Nickname' => $Nickname,
    ]);
    $result = $verify->fetch();
    return($result['Password'] == $value);
}
?>