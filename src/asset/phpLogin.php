<?php 
  $returnmsg = "";
  require("../func/functionSql.php");
  require("../func/connectAccount.php");
    $mail = $_POST["email"];
    $password = $_POST["password"];
    if ($mail == NULL && $returnmsg == ""|| $password == NULL && $returnmsg == "") {
      $returnmsg= "Please fill out the gaps ";
    }
    if ($returnmsg == "") {
      if(testValueUserName($mail)=="" && $returnmsg == ""){
        if (testValueUserMail($mail)=="" && $returnmsg == "") {
            $returnmsg =  "sorry but the username or email is not good";
        }else {
          $nameUserCookie = testValueUserMail($mail);
        }
      }else {
        $nameUserCookie = testValueUserName($mail);
      }
    }
    if ($returnmsg == "") {
      if(!testValuePassword($password,$nameUserCookie)){
        $returnmsg =  "sorry but the password is not good";
      }
    }
    
    if($returnmsg == ""){
      setcookie("name",$nameUserCookie,time()+36000,"/","localhost");
      require("../func/checkHabit.php");
      checkHabit($mail);
      
    }
?>
