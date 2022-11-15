<?php
//On démarre la session
session_start();

//connexion à la base de donnée MySQL
require("connectAccount.php");

// On vérifie si l'utilisateur est connecté
if(isset($_COOKIE["name"]) == true) {

// On récupère son idGroup et sa dernière connexion dans la table 'user'
$sql = "SELECT idGroup, lastConnection FROM `user` WHERE idGroup, lastConnexion = '".$_COOKIE["Name"]."'";
// On récupère le score du Groupe dont fait partie l'utilisateur
$sql = "SELECT score FROM `group` WHERE score = '".$_COOKIE["Name"]."'";

$_GET['score'] = $score;

echo $score;

}
else {
  // Sinon on informe qu'il n'est pas connecté
    echo "Vous n'êtes pas connecté";

}

exit();

?>
