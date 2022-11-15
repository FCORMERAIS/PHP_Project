<?php
//On démarre la session
session_start();

//connexion à la base de donnée MySQL
require("connectAccount.php");

// On vérifie si l'utilisateur est connecté
if(isset($_COOKIE["name"]) == true) {

// On répurère les informations de l'utilisateur : son idGroup et sa date de dernière connexion
$requete = $mysqli->query("SELECT idGroup, lastConnection FROM `user` WHERE Name = '".$_COOKIE["name"]."'");



}
else {
  // Sinon on informe qu'il n'est pas connecté
    echo "Vous n'êtes pas connecté";
}









//récupération des données du formulaire
$idGroup = $_POST['idGroup'];
$lastConnexion = $_POST['lastConnexion'];

//On récupère le score du groupe dont fais partis l'utilisateur
$sql = "SELECT score FROM `groups` WHERE idGroup = '$idGroup'";
 $score = $_GET['score'];

//On revoie le score de l'utilisateur à la page menu.php
header("Location: menu.php?score=$score");


?>
