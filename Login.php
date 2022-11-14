<?php 
  $returnmsg = "";
  require("connectAccount.php");
    $mail = $_POST["email"];
    $password = $_POST["password"];
//encrypte the password password_hash($password, PASSWORD_DEFAULT)
    password_hash($password, PASSWORD_DEFAULT);
    
    if ($mail == NULL && $returnmsg == ""|| $password == NULL && $returnmsg == "") {
      $returnmsg= "Please fill out the gaps ";
    }

    if ($returnmsg == "") {
      if(!testValueUser("phpproject","localhost","Name",$mail) && $returnmsg == ""){
        if (!testValueUser("phpproject","localhost","Mail",$mail) && $returnmsg == "") {
            $returnmsg =  "sorry but the username or email is not good";
        }
      }
    }

    if ($returnmsg == "") {
      if(!testValueUser("phpproject","localhost","Password",$password) && $returnmsg== ""){
          $returnmsg =  "sorry but the password is not good";
      } 
    }

    if($returnmsg == ""){
      setcookie("name",$mail,time()+3600);
      header("Location: /PHPProject/menu.php");
      exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Taskmanager: Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
      // session_start();
      if (
          (isset($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
          || (isset($_POST['message']) &&  empty($_POST['message']))
          )
      {
        ?>
          <script>console.log("pas de login")</script>
        <?php
      }else{
        if(isset($_POST['login'])){
          //TODO Cookies HERE


          ?>
            <meta http-equiv="Refresh" content="0; url=Menu.php" />
          <?php

        }else{
          ?>
            <script>console.log("pas de login")</script>
          <?php
        } 
      }
    ?>
  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
        <div class="loginbackground-gridContainer">
          <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
            <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(147, 147, 147) 33%); flex-grow: 1;">
            </div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
            <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
            <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
            <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
            <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
            <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
            <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
            <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
            <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
          </div>
        </div>
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <h1>TASKMANAGER</h1>
        </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">Login to your account</span>
              <form method="post" action="Login.php" id="stripe-login">
                <div class="field padding-bottom--24">
                  <label for="email">Email or Pseudo</label>
                  <input type="hidden" name="login" value="true">
                  <input type="text" name="email">
                </div>
                <div class="field padding-bottom--24">
                  <div class="grid--50-50">
                    <label for="password">Password</label>
                    <div class="reset-pass">
                      <a href="#">Forgot your password?</a>
                    </div>
                  </div>
                  <input type="password" name="password">
                </div>
                <div class="field padding-bottom--24">
                  <input type="submit" name="submit" value="Continue">
                </div>
                <div class="textalign">
                  <?php echo $returnmsg; ?>
                </div>
              </form>
            </div>
          </div>
          <div class="footer-link padding-top--24">
            <span>Don't have an account? <a href="Signin.php">Sign up</a></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
