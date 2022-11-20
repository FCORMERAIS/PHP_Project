<?php
//On démarre la session
session_start();

//connexion à la base de donnée MySQL
require("connectAccount.php");

// On vérifie si l'utilisateur est connecté
if(isset($_COOKIE["Name"]) == true) {

// On récupère son idGroup et sa dernière connexion dans la table 'user'
$sql = "SELECT idGroup, lastConnection FROM `user` WHERE idGroup, lastConnexion = '".$_COOKIE["Name"]."'";
$_GET['idGroup'] = $idGroup;
$_GET['lastConnection'] = $lastConnection;

// on accède à la table 'groupe' à travers idGroup de l'utilisateur
$sql = "SELECT * FROM `groupe` WHERE idGroup = '".$_GET['idGroup']."'";

// on récupere le score du groupe en question
$sql = "SELECT score FROM `groupe` WHERE idGroup = '".$_GET['idGroup']."'";

$_GET['score'] = $score;


echo "$score $idGroup $lastConnection";

}
else {
  // Sinon on informe qu'il n'est pas connecté
    echo "Vous n'êtes pas connecté";

}

exit();

?>
