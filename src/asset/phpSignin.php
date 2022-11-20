<?php
session_start(); 
  $returnmsg = "";
  require("../func/connectAccount.php");
  require "../func/functionSql.php";
  $mail = $_POST["email"];
  $password = $_POST["password"];
  $pseudo = $_POST["Pseudo"];
  if ($mail == NULL && $returnmsg == ""|| $password == NULL && $returnmsg == "" || $pseudo == NULL && $returnmsg == "") {
    $returnmsg= "Please fill out the gaps";
  }

  if ($returnmsg == "") {
    if(testValueUserName($pseudo) && $returnmsg == ""){
      $returnmsg = "Sorry but the nickname is already use";
    }
    if (testValueUserMail($mail) && $returnmsg == "") {
      $returnmsg =  "sorry but the email is arlready use";
    }
  }

  if($returnmsg == ""){
    $serverName = "localhost";
    $name = $_POST["Pseudo"];
    $mail = $_POST["email"];
    $password = $_POST["password"];
    $db = "phpproject";

    $connexion = mysqli_connect($serverName,"root","",$db);

    if(!$connexion || $name == "") {die("pb de conextion".mysqli_connect_error());}
    try
    {
      $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
    catch (Exception $e)
    {
      die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery = "INSERT INTO user(Name,Password,Mail,invitationGroups,idGroup) VALUE (:name,:password,:mail,'','')";
    $SQLREQUEST = $db->prepare($sqlQuery);
    $SQLREQUEST->execute([
        'name' => $name,
        'password' => $password,
        'mail' => $mail,
    ]);
    setcookie("name",$name,time()+36000,"/","localhost");
    mysqli_close($connexion);
    header("Location: /PHPProject/src/component/menu.php");
    exit();
  }
