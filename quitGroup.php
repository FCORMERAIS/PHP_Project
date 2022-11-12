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
    
    $name = "BOUBALIN";
    // Ecriture de la requête
    $sqlQuery = 'UPDATE user SET idGroup = "" WHERE Name = :nameUser';
    $insertGroups = $db->prepare($sqlQuery);
    $insertGroups->execute([
        'nameUser' => $name, //TODO allez chercher le name dans les cookies ou truc comme ca.
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