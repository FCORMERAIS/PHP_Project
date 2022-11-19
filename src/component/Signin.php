<?php 
  session_start(); 
  $returnmsg = "";
  require("../func/connectAccount.php");
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
    setcookie("name",$name,time()+36000);
    mysqli_close($connexion);
    header("Location: /PHPProject/src/component/menu.php");
    exit();
  }


include "../asset/headerLogin.php";
?>

<body>
  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
        <div class="loginbackground-gridContainer">
          <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
            <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
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
          <h1>TASKMANAGER<a href="menu.php"></a></h1>
        </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">Sign in to your account</span>
              <form method="post" id="stripe-login" action="">
              <div class="field padding-bottom--24">
                  <label for="Pseudo">Pseudo</label>
                  <input type="text" name="Pseudo">
                </div>
                <?php if ($returnmsg == "Sorry but the nickname is already use") {echo $returnmsg;} ?>
                <div class="field padding-bottom--24">
                  <label for="email">Email</label>
                  <input type="email" name="email">
                </div>
                <?php if ($returnmsg == "sorry but the email is arlready use") {echo $returnmsg;} ?>
                <div class="field padding-bottom--24">
                  <div class="grid--50-50">
                    <label for="password">Password</label>
                  </div>
                  <input type="password" name="password">
                </div>
                <div class="field field-checkbox padding-bottom--24 flex-flex align-center">
                  <label for="checkbox">
                    <input type="checkbox" name="checkbox"> Stay signed in for a week
                  </label>
                </div>
                <?php if ($returnmsg == "Please fill out the gaps") {echo $returnmsg;}?>
                <div class="field padding-bottom--24">
                  <input type="submit" name="submit" value="Continue">
                </div>
                <div class="field">
                  <a class="ssolink" href="#">Use single sign-on (Google) instead</a>
                </div>
              </form>
            </div>
          </div>
          <div class="footer-link padding-top--24">
            <span>You already have an account ? <a href="Login.php">Login</a></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>