<?php

$serverName = "localhost";
$mail = $_POST["email"];
$password = $_POST["password"];
$db = "phpproject";

$connexion = mysqli_connect($serverName,"root","",$db);

if(!$connexion) {die("pb de conextion".mysqli_connect_error());}
$sql = "SELECT COUNT(1) FROM user WHERE Name ='$mail'";
$resultPassword = $connexion->query($sql);

if (!$resultPassword && $resultPassword != "" && $resultPassword != 0) {
    $sql = "SELECT COUNT(1) FROM user WHERE Mail ='$mail'";
    $resultPassword = $connexion->query($sql);
}

if (!$resultPassword && $resultPassword != "" && $resultPassword != 0) {
    echo "The username or mail is not good";
    die();
}

if($password == $resultPassword) {
    echo "connexion accepted";
}else {
    echo "le mdp n'est pas bon $password != ";
}

mysqli_close($connexion);
// header("Location: http://localhost/PHPProject/menu.php");
// exit();
?>