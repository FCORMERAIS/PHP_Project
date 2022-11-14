<?php
function listUser(){
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery = 'SELECT * FROM user WHERE idGroup = 33';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute();
    $groups = $groupsStatement->fetchAll();
    // On affiche chaque groupe un à un
    foreach ($groups as $group) {
    ?>
        <p><?php echo $group['Name']; ?></p>
    <?php
    }
}

?>