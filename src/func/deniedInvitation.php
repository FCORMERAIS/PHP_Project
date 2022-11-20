<?php 
    require("../func/functionSql.php");
    $sqlQuery = 'SELECT id FROM groups WHERE chief = :userchief';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute([
        'userchief' => $_POST["nameInvit"],
    ]);
    $idgroup = SQLREQUEST($sqlQuery,$_POST["nameInvit"],"fetch");

    $sqlQuery = 'SELECT invitationGroups FROM user WHERE Name = :username';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute([
        'username' => htmlspecialchars($_COOKIE["name"]),
    ]);
    $result = SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");

    $listinvit = $result["invitationGroups"];
    $listinvit = explode(" ",$listinvit);
    echo $listinvit[0].$listinvit[1].$idgroup["id"];
    for ($i=0; $i < count($listinvit); $i++) { 
        if ($listinvit[$i] == $idgroup["id"]) {
            $listinvit[$i] = "";
        }
    }
    $sqlQuery = 'UPDATE user SET invitationGroups = :listinvit WHERE Name = :username';
    SQLREQUEST($sqlQuery,htmlspecialchars($_COOKIE["name"]),join(" ",$listinvit));
    header("Location: /PHPProject/src/component/menu.php");
    exit();
?>