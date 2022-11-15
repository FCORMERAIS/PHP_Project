<?php

$name = $_POST["Name"];
$Periodicity = $_POST["Periodicity"];
$Description = $_POST["Description"];
$Difficulty = $_POST["Difficulty"];
$group = "32";

try
{
    $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$sql = "INSERT INTO activity(groups, name,text,periodicity,difficulty) VALUE (:groups,:name,:text,:periodicity,:difficulty)";

$insertGroups = $db->prepare($sql);

// Exécution ! Le groupe est maintenant en base de données
$insertGroups->execute([
    'groups' => $group,
    'name' => $name,
    'text' => $Description,
    'periodicity' => $Periodicity,
    'difficulty' => $Difficulty,
]);

?>
<meta http-equiv="Refresh" content="0; url=Menu.php" />
