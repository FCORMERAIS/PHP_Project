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
    $sqlQuery = 'SELECT idGroup FROM user WHERE Name = :nameUser';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute([
        'nameUser' => htmlspecialchars($_COOKIE["name"]),
    ]);

    $GrouporNot = $groupsStatement->fetch();

    if ($GrouporNot["idGroup"] == "" || $GrouporNot["idGroup"] == NULL) {
        $sqlQuery = 'SELECT id FROM groups WHERE chief = :userchief';
        $groupsStatement = $db->prepare($sqlQuery);
        $groupsStatement->execute([
            'userchief' => $_POST["nameInvit"],
        ]);
        $idgroup = $groupsStatement->fetch();

        $sqlQuery = 'UPDATE user SET idGroup = :idgroup WHERE Name = :username';
        $groupsStatement = $db->prepare($sqlQuery);
        $groupsStatement->execute([
            'idgroup' => $idgroup["id"],
            'username' => htmlspecialchars($_COOKIE["name"]),
        ]);
        $sqlQuery = 'UPDATE user SET invitationGroups = "" WHERE Name = :username';
        $groupsStatement = $db->prepare($sqlQuery);
        $groupsStatement->execute([
            'username' => htmlspecialchars($_COOKIE["name"]),
        ]);
    }
    header("Location: /PHPProject/src/component/menu.php");
    exit();
?>