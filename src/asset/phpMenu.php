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
  