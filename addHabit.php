<?php

$name = $_POST["Name"];
$Periodicity = $_POST["Periodicity"];
$Description = $_POST["Description"];
$Difficulty = $_POST["Difficulty"];
$group = "32";

try
{
    $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
$sqlQuery = 'SELECT * FROM user WHERE Name = :nameUser';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute([
        'nameUser' => $_COOKIE['name'],
    ]);
    $user = $groupsStatement->fetch();
if (strtotime($user['lastTimeAddHabit'])+24*3600<time()){
    $sqlQuery = 'UPDATE user SET lastTimeAddHabit = :lastTime WHERE Name = :nameUser';
    $insertGroups = $db->prepare($sqlQuery);
    $insertGroups->execute([
        'lastTime' => date('Y-m-d H:i:s',time()),
        'nameUser' => $_COOKIE["name"],
    ]);
    $sql = "INSERT INTO activity(groups, name,text,periodicity,lastTimeDo,difficulty) VALUE (:groups,:name,:text,:periodicity,FROM_UNIXTIME(:lastTimeDo),:difficulty)";
    $insertGroups = $db->prepare($sql);
    // Exécution ! Le groupe est maintenant en base de données
    $insertGroups->execute([
        'groups' => $group,
        'name' => $name,
        'text' => $Description,
        'periodicity' => $Periodicity,
        'lastTimeDo' => strtotime('tomorrow')-3600,
        'difficulty' => $Difficulty,
    ]);    
}

?>
<meta http-equiv="Refresh" content="0; url=Menu.php" />
