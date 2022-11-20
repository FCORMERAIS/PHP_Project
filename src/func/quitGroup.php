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
    $insertGroups = $db->prepare($sqlQuery);
    $insertGroups->execute([
        'nameUser' => htmlspecialchars($_COOKIE["name"]),
    ]);
    $result = $insertGroups->fetch();
    if ($result == "") {
        ?>
        <script>alert("You are not in a group")</script>
        <?php
    }else {
        // Ecriture de la requête
        $sqlQuery = 'UPDATE user SET idGroup = "" WHERE Name = :nameUser';
        $insertGroups = $db->prepare($sqlQuery);
        $insertGroups->execute([
            'nameUser' => htmlspecialchars($_COOKIE["name"]),
        ]);
        
        $sqlQuery = 'SELECT id FROM groups WHERE chief = :nameUser';
        $Lookchief = $db->prepare($sqlQuery);
        $Lookchief->execute([
            'nameUser' => htmlspecialchars($_COOKIE["name"]),
        ]);
        $groupchief = $Lookchief->fetch();
        $idgroupdelete = $groupchief["id"];
        $sqlQuery = 'DELETE FROM groups WHERE groups.id = :idgroup';
        $deletegroup = $db->prepare($sqlQuery);
        $deletegroup->execute([
            'idgroup' => $idgroupdelete,
        ]);

        $sqlQuery = 'UPDATE user SET idGroup = "" WHERE idGroup = :idgroup';
        $Groupdelete = $db->prepare($sqlQuery);
        $Groupdelete-> execute([
            'idgroup' => $idgroupdelete,
        ]);
        
        $sqlQuery = 'UPDATE user SET invitationGroups = TRIM(:idgroup FROM invitationGroups)';
        $Groupdelete = $db->prepare($sqlQuery);
        $Groupdelete-> execute([
            'idgroup' => $idgroupdelete,
        ]);
        ?>
        <script>alert("You have quit your group")</script>
        <?php
    }

    //TODO ajouter a l'utilisateur le groups en FOREING KEY
    
    // On récupère tout le contenu de la table groups
    // $sqlQuery = 'SELECT * FROM groups';
    // $groupsStatement = $db->prepare($sqlQuery);
    // $groupsStatement->execute();
    // $groups = $recipesStatement->fetchAll();
    
    // // On affiche chaque groupe un à un
    // foreach ($groups as $group) {
    // }
    ?>
    <meta http-equiv="Refresh" content="0; url=../component/Menu.php" />
    <?php

?>