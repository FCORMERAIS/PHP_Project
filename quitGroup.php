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
    
    // Ecriture de la requête
    $sqlQuery = 'UPDATE user SET idGroup = "" WHERE Name = :nameUser';
    $insertGroups = $db->prepare($sqlQuery);
    $insertGroups->execute([
        'nameUser' => htmlspecialchars($_COOKIE["name"]),
    ]);
    
    $sqlQuery = 'SELECT id FROM groups WHERE name = :nameUser';
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
    $deleteInvitation = $db->prepare($sqlQuery);
    $deleteInvitation -> execute([
        'idgroup'=> $idgroupdelete,
    ]);
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
    <meta http-equiv="Refresh" content="0; url=Menu.php" />
    <?php

?>