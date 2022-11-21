<?php 
  $returnmsg = "";
  include("../func/Actions.php");
  //Verifie if the user can connect to the db with his name and password
    $mail = $_POST["email"];
    $password = $_POST["password"];
    if ($mail == NULL && $returnmsg == ""|| $password == NULL && $returnmsg == "") {
      $returnmsg= "Please fill out the gaps ";
    }
    if ($returnmsg == "") {
      if($action->testValueUserName($mail)=="" && $returnmsg == ""){
        if ($action->testValueUserMail($mail)=="" && $returnmsg == "") {
            $returnmsg =  "sorry but the username or email is not good";
        }else {
          $nameUserCookie = $action->testValueUserMail($mail);
        }
      }else {
        $nameUserCookie = $action->testValueUserName($mail);
      }
    }
    if ($returnmsg == "") {
      if(!$action->testValuePassword($password,$nameUserCookie)){
        $returnmsg =  "sorry but the password is not good";
      }
    }
    //set a cookie
    if($returnmsg == ""){
      setcookie("name",$nameUserCookie,time()+36000,"/","localhost");
      $action->checkHabit($mail);
      
    }
?>
