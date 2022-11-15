<?php
//On démarre la session
session_start();

//connexion à la base de donnée MySQL
require("connectAccount.php");

// On vérifie si l'utilisateur est connecté
if(isset($_COOKIE["name"]) == true) {

// On récupère son idGroup et sa dernière connexion dans la table 'user'
$requete = $bdd->prepare('SELECT idGroup, lastConnection FROM user WHERE idGroup,lastConnexion = :idGroup, :lastConnection');

// On récupère le score du Groupe dont fait partie l'utilisateur
$requete = $bdd->prepare('SELECT score FROM group WHERE score = :score');

$_GET['score'] = $score;

// On renvoie le score à la page 'menu.php' dans le header.
header('Location: menu.php?score=' . $score);
// on ferme la session
session_close();
}
else {
  // Sinon on informe qu'il n'est pas connecté
    echo "Vous n'êtes pas connecté";
session_close();
}

exit();

?>
