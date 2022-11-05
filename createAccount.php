<?php


$serverName = "localhost";
$name = $_POST["Pseudo"];
$mail = $_POST["email"];
$password = $_POST["password"];
$db = "phpproject";


$connexion = mysqli_connect($serverName,"root","",$db);

if(!$connexion) {die("pb de conextion".mysqli_connect_error());}

$sql = "INSERT INTO user(Id,Name,Password,Mail) VALUE ('1','$name','$password','$mail')";

if(mysqli_query($connexion,$sql)){
    echo "good";
}else { "error deso poto";}

mysqli_close($connexion);

?>