<?php
//On démarre la session
session_start();

//connexion à la base de donnée MySQL
include("../func/Actions.php");

// define variables and set to empty values
$login = $password = "";
$connexion = mysqli_connect("localhost","root","","phpproject");
$db = "phpproject";

// On vérifie si l'utilisateur est connecté
if(isset($_COOKIE["name"]) == true) {

// recover scoring of the user from `group` table by using idGroup
$sqlQuery = "SELECT score FROM `groups` WHERE idGroup = '".$_COOKIE["name"]."')";


$result = mysqli_query($connexion, $sqlQuery);



// // affiche le score de l'utilisateur
// echo "Votre score est de : ".$result;

if ($result == 0) {
    echo "Vous n'avez pas encore de score";
} else {
    echo "Votre score est de : ".$result;
}

} 

else {
  // Sinon on informe qu'il n'est pas connecté
    echo "Vous n'êtes pas connecté";

}

exit();

?>
