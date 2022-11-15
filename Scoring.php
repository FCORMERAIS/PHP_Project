<?php
//On démarre la session
session_start();

//connexion à la base de donnée MySQL
require("connectAccount.php");

//récupération des données du formulaire
$login = $_POST['login'];
$password = $_POST['password'];
$idGroup = $_POST['idGroup'];
$lastConnexion = $_POST['lastConnexion'];

//On récupère le score du groupe dont fais partis l'utilisateur
$sql = "SELECT score FROM `group` WHERE idGroup = '$idGroup'";
 $score = $_GET['score'];

//On revoie le score de l'utilisateur sur Menu.php
header("Location: /PHPProject/menu.php?score=$score");

?>
