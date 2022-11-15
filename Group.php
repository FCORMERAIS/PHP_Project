<?php
//On démarre la session
session_start();

//connexion à la base de donnée MySQL
require("connectAccount.php");

//GET score
$score = $_GET['score'];

if ($score == 0) {
  // Méthode/fonction qui dissout le groupe

}


?>