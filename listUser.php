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
    $sqlQuery = 'SELECT idGroup FROM user WHERE Name = :nameuser';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute([
        'nameuser' => $_COOKIE["name"],
    ]);
    $id = $groupsStatement->fetch();
    if ($id["idGroup"] != "") {
        $sqlQuery = 'SELECT Name FROM user WHERE idGroup=:id';
        $groupsStatement = $db->prepare($sqlQuery);
        $groupsStatement->execute([
            'id' => $id["idGroup"],
        ]);
        $groups = $groupsStatement -> fetchAll();
        // On affiche chaque groupe un à un
        foreach ($groups as $name) {
        ?>
            <h2><?php echo $name["Name"]; ?></h2>
        <?php
        }
    }
}

?>