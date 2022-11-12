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
$sqlQuery = 'INSERT INTO groups(score,name) VALUES (:score,"")';

// Préparation
$insertGroups = $db->prepare($sqlQuery);

// Exécution ! Le groupe est maintenant en base de données
$insertGroups->execute([
    'score' => 0,
]);

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
<meta http-equiv="Refresh" content="0; url=Menu.php" />
