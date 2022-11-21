<?php 
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery = 'SELECT id FROM groups WHERE chief = :userchief';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute([
        'userchief' => $_POST["nameInvit"],
    ]);
    $idgroup = $groupsStatement->fetch();

    $sqlQuery = 'SELECT invitationGroups FROM user WHERE Name = :username';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute([
        'username' => htmlspecialchars($_COOKIE["name"]),
    ]);
    $result = $groupsStatement->fetch();

    $listinvit = $result["invitationGroups"];
    $listinvit = explode(" ",$listinvit);
    echo $listinvit[0].$listinvit[1].$idgroup["id"];
    for ($i=0; $i < count($listinvit); $i++) { 
        if ($listinvit[$i] == $idgroup["id"]) {
            $listinvit[$i] = "";
        }
    }
    $sqlQuery = 'UPDATE user SET invitationGroups = :listinvit WHERE Name = :username';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute([
        'username' => htmlspecialchars($_COOKIE["name"]),
        'listinvit' => join(" ",$listinvit)
    ]);
    header("Location: /PHPProject/src/component/menu.php");
    exit();
?>