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
    ?> <script>alert("Vous ne pouvez pas ajouter une habitude car vous en avez deja ajouter une il y a - de 24h.")</script> <?php
  }
  if(isset($_GET["rep2"]) && $_GET["rep2"]=="false") {
    ?> <script>alert("Vous ne devez pas laisser d'espaces vide pour pouvoir ajouter une habitude.")</script> <?php
  }
  if(isset($_GET["rep3"]) && $_GET["rep3"]=="false") {
    ?> <script>alert("Vous êtes déjà dans un groupe veuillez le quitter pour pouvoir en rejoindre un autre.")</script> <?php
  }
  if(isset($_GET["rep4"]) && $_GET["rep4"]=="false") {
    ?><script> alert("Vous devez rejoindre un groupe et être chef pour inviter quelqu'un.")</script> <?php
  }
  if(isset($_GET["rep5"]) && $_GET["rep5"]=="false") {
    ?><script> alert("Vous êtes déjà dans un groupe")</script> <?php
  }
  if(isset($_GET["rep6"]) && $_GET["rep6"]=="false") {
    ?><script> alert("Vous n'êtes dans aucun groupe")</script> <?php
  }
  if(isset($_GET["rep7"]) && $_GET["rep7"]=="false") {
    ?><script> alert("Cet utilisateur a déja été inviter ")</script> <?php
  }
  if(isset($_GET["rep8"]) && $_GET["rep8"]=="false") {
    ?><script> alert("Cet utilisateur n'existe pas ")</script> <?php
  }

  