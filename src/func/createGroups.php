
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
$sqlQuery = 'SELECT Name FROM user WHERE idGroup != "" AND Name = :cookieconnect';
$verify = $db->prepare($sqlQuery);
$verify->execute([
    'cookieconnect' => htmlspecialchars($_COOKIE["name"]),
]);
$result = $verify -> fetchAll();

// Ecriture de la requête
if (count($result) == 0) {
    $sqlQuery = 'INSERT INTO groups(score,chief,name) VALUES (:score,:name,:groupname)';

    // Préparation
    $insertGroups = $db->prepare($sqlQuery);

    // Exécution ! Le groupe est maintenant en base de données
    $insertGroups->execute([
        'score' => 1000,
        'name' => htmlspecialchars($_COOKIE["name"]),
        'groupname' => $_POST["NameGroup"],
    ]);

    $sqlQuery = 'SELECT id FROM groups WHERE chief = :cookiename';
    $getid = $db->prepare($sqlQuery);
    $getid->execute([
        'cookiename' => htmlspecialchars($_COOKIE["name"]),
    ]);
    
    $id = $getid->fetch();

    $sqlQuery = 'UPDATE user SET idGroup = :id WHERE name = :cookiename';
    $changeId = $db->prepare($sqlQuery);
    $changeId->execute([
        'id' => $id["id"],
        'cookiename' => htmlspecialchars($_COOKIE["name"]),
    ]);
}

//TODO ajouter a l'utilisateur le groups en FOREING KEY

// On récupère tout le contenu de la table groups
// $sqlQuery = 'SELECT * FROM groups';
// $groupsStatement = $db->prepare($sqlQuery);
// $groupsStatement->execute();
// $groups = $recipesStatement->fetchAll();

// // On affiche chaque groupe un à un
// foreach ($groups as $group) {
?>
    <!-- <p><?php echo $group['id']; ?></p> -->
<?php
// }
?>
<meta http-equiv="Refresh" content="0; url=../component/Menu.php" />