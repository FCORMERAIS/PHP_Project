<?php

$name = $_POST["Name"];
$Periodicity = $_POST["Periodicity"];
$Description = $_POST["Description"];
$Difficulty = $_POST["Difficulty"];
require "../func/functionSql.php";
$sqlQuery = 'SELECT * FROM user WHERE Name = :nameUser';
    $user =SQLREQUEST($sqlQuery,$_COOKIE['name']);
    $group = $user["idGroup"];
if (strtotime($user['lastTimeAddHabit'])+24*3600<time()){
    $sqlQuery = 'UPDATE user SET lastTimeAddHabit = :lastTime WHERE Name = :nameUser';
    SQLREQUEST($sqlQuery,date('Y-m-d H:i:s',time()),$_COOKIE["name"]);
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
<meta http-equiv="Refresh" content="0; url=../component/Menu.php" />
