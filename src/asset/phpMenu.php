<?php session_start()?>
<?php
//verify if we are connected
  include("../func/Actions.php");
  $db = new DB();
  if(!isset($_COOKIE["name"]))
    {$connexion ="You are not connected";
  }else { 
    $connexion = 'Connected As ' . htmlspecialchars($_COOKIE["name"]) . ' !';
  }
  if (isset($_POST["check"])&& !empty($_POST["check"]) && $_POST["check"]=="true"){
    $action->checkList();
  }
  if (isset($_GET["rep"]) && $_GET["rep"]=="false"){
    ?> <script>alert("Vous ne pouvez pas ajouter une habitude car vous en avez deja ajouter une il y a - de 24h")</script> <?php
  }
  