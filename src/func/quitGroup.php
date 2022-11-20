<?php    
    $sqlQuery = 'SELECT idGroup FROM user WHERE Name = :nameUser';
    $result = SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");
    if ($result == "") {
        ?>
        <script>alert("You are not in a group")</script>
        <?php
    }else {
        // Ecriture de la requête
        $sqlQuery = 'UPDATE user SET idGroup = "" WHERE Name = :nameUser';
        SQLREQUEST($sqlQuery,$_COOKIE["name"]);
        $sqlQuery = 'SELECT id FROM groups WHERE chief = :nameUser';
        $groupchief = SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");
        $idgroupdelete = $groupchief["id"];
        $sqlQuery = 'DELETE FROM groups WHERE groups.id = :idgroup';
        $deletegroup = $db->prepare($sqlQuery);
        $deletegroup->execute([
            'idgroup' => $idgroupdelete,
        ]);

        $sqlQuery = 'DELETE FROM activity WHERE groups = :idgroup';
        $Groupdelete = $db->prepare($sqlQuery);
        $Groupdelete-> execute([
            'idgroup' => $idgroupdelete,
        ]);

        $sqlQuery = 'UPDATE user SET idGroup = "" WHERE idGroup = :idgroup';
        SQLREQUEST($sqlQuery,$idgroupdelete);
        
        $sqlQuery = 'UPDATE user SET invitationGroups = TRIM(:idgroup FROM invitationGroups)';
        SQLREQUEST($sqlQuery,$idgroupdelete);

        $sqlQuery = 'UPDATE activity SET checklist = TRIM(:username FROM checklist)';
        SQLREQUEST($sqlQuery,$_COOKIE['name']);
        
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