<?php

$serverName = "localhost";
$name = $_POST["Pseudo"];
$mail = $_POST["email"];
$password = $_POST["password"];
$db = "phpproject";

$connexion = mysqli_connect($serverName,"root","",$db);

if(!$connexion || $name == "") {die("pb de conextion".mysqli_connect_error());}

$sql = "SELECT MAX(Id) FROM user";
$result = $connexion->query($sql);

$result+=1;

$sql = "INSERT INTO user(Id,Name,Password,Mail) VALUE ('$result','$name','$password','$mail')";

if(mysqli_query($connexion,$sql)){
    echo "good";
}else { "error deso poto";}

mysqli_close($connexion);
header("Location: http://localhost/PHPProject/menu.php");
exit();
?>