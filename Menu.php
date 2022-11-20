<?php session_start()?>
<?php
  if (
      (isset($_POST['userAdd'])&& !empty($_POST['userAdd']) )
      )
  {
    $name = htmlspecialchars($_COOKIE["name"]);
    require('addUser.php');
    addUser($_POST['userAdd']);
  }
  if(!isset($_COOKIE["name"]))
    {$connexion ="You are not connected";
  }else { 
    $connexion = 'Connected As ' . htmlspecialchars($_COOKIE["name"]) . ' !';
  }
  if (isset($_POST['check'])&& !empty($_POST['check']) && $_POST['check']=="true"){
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery = 'SELECT * FROM activity WHERE name = :nameHabit';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute(
        [
            'nameHabit'=>$_POST["nameHabit"],
        ]);
    $habit = $groupsStatement->fetch();
    $checkList="";
    if ($habit['checkList'] != "" || $habit['checkList'] != null){
        if(in_array($_COOKIE["name"],explode(" ",$habit['checkList']))){
            if (count(explode(" ",$habit['checkList']))!=1){
                $a = explode(" ",$habit['checkList']);
                $key = array_search($_COOKIE["name"], $a);
                unset($a[$key]);
                $checkList=join(" ",$a);
            }else{
                $checkList = null;
            }
            
        }else{
            $checkList=$habit['checkList']." ".$_COOKIE["name"];
        }
    }else{
        $checkList=$_COOKIE["name"];
    }
    $sqlQuery = 'UPDATE activity SET checkList = :checkList WHERE name = :nameHabit';
    $insertGroups = $db->prepare($sqlQuery);
    $insertGroups->execute([
        'checkList'=>$checkList,
        'nameHabit' => $_POST['nameHabit'],
    ]);
  }
    ?>  
<!DOCTYPE php>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Navbar</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css.php">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    </head>
    <body class="corps">
        <header>
            <a class="logo" href="/PHPProject/Menu.php"><img src="me.jpg" alt="logo" height="50" width="50" ></a>
            <nav>
                <ul class="nav__links">  
                    <li><FONT size="6pt"><a href="#">Profil</a></FONT></li>
                    <li><FONT size="6pt"><a href="Group.php">Group</a></FONT></li>
                    <li><FONT size="6pt"style="color: rgba(0, 136, 169, 0.8);"><?php echo $connexion;?></FONT size="6pt"></li>
                </ul>
            </nav>
            <p class="tempo">h</p>
            <p class="menu cta">Contact</p>
            <?php
                if(isset($_COOKIE["name"])) {
                    echo '<p class="connect"><a href="deco.php">Disconnect</a></p>';
                }else {
                    echo '<p class="connect"><a href="Login.php">Login</a></p>';
                }
            ?>
        </header>
            <?php
                if ($connexion == "You are not connected") {
                    ?>
                    <p class="redInfo">
                    <?php
                    echo "YOU NEED TO BE CONNECTED AND TO JOIN A GROUP FOR GET INFORMATION ON YOUR GROUP";
                    ?>
                    </p>
                    <?php
                }else{

                    ?>
                    <?php
                    ?>
                    <div class="invitation">
                        <p>
                            <?php
                                try
                                {
                                    $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                                );
                                }
                                catch (Exception $e)
                                {
                                        die('Erreur : ' . $e->getMessage());
                                }
                                
                                // Ecriture de la requête
                                $sqlQuery = 'SELECT invitationGroups FROM user WHERE Name = :nameUser';
                                $insertGroups = $db->prepare($sqlQuery);
                                $insertGroups->execute([
                                    'nameUser' => htmlspecialchars($_COOKIE["name"]),
                                ]);
                                $res = $insertGroups->fetch();
                                $listInvit = explode(" ",$res["invitationGroups"]);
                                for ($i = 0;$i<count($listInvit);$i++) {
                                    if ($listInvit[$i] != "") {
                                        $sqlQuery = 'SELECT name,chief FROM groups WHERE id = :idgroup';
                                        $insertGroups = $db->prepare($sqlQuery);
                                        $insertGroups->execute([
                                            'idgroup' => $listInvit[$i],
                                        ]);
                                        $row = $insertGroups->fetch();
                                        echo "<div class='invit'></br></br>".$row["chief"] . " AS INVITE YOU TO JOIN ".$row["name"]."  ";
                                        echo '<form action="AcceptInvitation.php" method="POST"><input type="hidden" value='.$row["chief"].' name="nameInvit"><input class="input" type="submit" name="submit" value="Accept">
                                        </form>
                                        <form action="deniedInvitation.php" method="POST"><input type="hidden" value='.$row["chief"].' name="nameInvit"><input class="input" type="submit" name="submit" value="Denied"></form></br></br></div>';
                                    }
                                }
                            ?>
                        </p>
                    </div> 
                    <?php
                    try
                    {
                        $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                    );
                    }
                    catch (Exception $e)
                    {
                        die('Erreur : ' . $e->getMessage());
                    }
                    $sqlQuery = 'SELECT * FROM user WHERE Name = :userCookie';
                    $groupsStatement = $db->prepare($sqlQuery);
                    $groupsStatement->execute(['userCookie'=> $_COOKIE["name"]],);
                    $IdGroupUser=$groupsStatement->fetch();

                    $sqlQuery = 'SELECT * FROM activity WHERE groups = :idGroup';
                    $groupsStatement = $db->prepare($sqlQuery);
                    $groupsStatement->execute(['idGroup' => $IdGroupUser["idGroup"]],);
                    $habits = $groupsStatement->fetchAll();

                    $sqlQuery = 'SELECT * FROM user WHERE idGroup = :idGroup';
                    $groupsStatement = $db->prepare($sqlQuery);
                    $groupsStatement->execute(['idGroup' => $IdGroupUser["idGroup"]],);
                    $user = $groupsStatement->fetchAll();
                    if ($IdGroupUser["idGroup"] != "" ) {
                        ?>
                        <div class="Habit">
                        <?php
                        foreach ($habits as $habit){
                            ?>
                            <div class="cardHabit">
                                <div class="titreHabit">
                                    <h2>
                                        <?php
                                            echo $habit["name"];    
                                        ?>
                                    </h2>
                                </div>
                                <div class="periodicity">
                                <p>
                                    <?php
                                        echo $habit["periodicity"];
                                    ?>
                                </p>
                                </div>
                                <div class="difficulty">
                                <p>
                                    <?php
                                        echo $habit["difficulty"];
                                    ?>
                                </p>
                                </div>
                                <div class="Description">
                                <p>
                                    <?php
                                        echo $habit["text"];
                                    ?>
                                </p>
                                </div>
                                <form class="" method="POST" action="Menu.php">
                                    <div class="check">
                                        <?php
                                        if(in_array($_COOKIE["name"],explode(" ",$habit['checkList']))){
                                            echo "<p>you already do it ! Wanna cancel it ?</p>";
                                        }else{
                                            echo "<p>you can do it !</p>";
                                        }  
                                        ?>
                                        <input type="submit" name="" value="check"> 
                                        <input type="hidden" name="check" value="true">
                                        <input type="hidden" name="nameHabit" value="<?php echo $habit['name'];?>">
                                </div>
                                </form>
                                <div class="nbDo">
                                    <p><?php 
                                    if($habit['checkList']!=""&& $habit['checkList']!=null &&$habit['checkList'] != " "){
                                        echo count(explode(" ",$habit['checkList']))."/".count($user)." ".$habit['checkList'];
                                    }else{
                                        echo "0/".count($user);
                                    }
                                    ?></p>
                                </div>
                                <div class="timeLeft">
                                    <p><?php  echo "il reste ".date("H:i",abs(time()-strtotime($habit['lastTimeDo'])));?></p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        </div>

                        <div class="containAddHabit">
                        <div class="login-box">
                            <h2>Habit</h2>
                            <form action="addHabit.php" name="forme" method="POST">
                            <div class="user-box">
                                <input type="text" name="Name" required="">
                                <label>Name</label>
                            </div>
                            <div class="user-box">
                                <input type="text" name="Description" required="">
                                <label>Description</label>
                            </div>
                            <div class="user-box2">
                                <label>Periodicity</label>
                                <select name="Periodicity" id="periodicity" >
                                    <option value="">--Please choose an option--</option>
                                    <option value="1DAY">1 DAY</option>
                                    <option value="2DAY">3 DAY</option>
                                    <option value="1WEEK">1 WEEK</option>
                                    <option value="2WEEK">2 WEEK</option>
                                    <option value="1MONTH">1 MONTH</option>
                                </select>   
                            </div>
                            <label>Difficulty</label>
                            <select name="Difficulty" id="difficulty" >
                                <option value="">--Please choose an option--</option>
                                <option value="S">S</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>   
                            <div class="ici">
                            </form>
        
                            <a onclick="submitPostLink()" href="#">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            add an habit
                            </a>
        
                            </div>
                            <script language=javascript>
                            function submitPostLink()
                            {
                            document.forme.submit();
                            }
                            </script>
                        </div>
                    </div> 
                    <?php
                    }else {
                        ?>
                        <p class="redInfo">
                            <?php
                        echo "You need to be in a Group for Add an Habit";
                    }
                }
                ?>
                    </p>
            <!-- <h1 class="title">WELCOME TO TASKMANAGER </h1> -->
        <div class="overlay"style="z-index: 50;">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <div class="box2">
                    <a href="#m2-o3" class="btna">Add Member Group</a>
                    <div class="modal-container" id="m2-o3" style="--m-background: hsla(0, 0%, 0%, .4);">
                        <div class="modal">
                            <h1 class="modal__title2">Add a Member </h1>
                            </br></br></br>
                                <span class="input">
                                    <form method="POST" action="Menu.php">
                                    <input type="text" name="userAdd" placeholder="Please enter the pseudo or email">
                                    <input type="submit">
                                    </form>
                                    <span></span>	
                                </span>
                                <p class="redInfo">
                                <?php
                                if (!isset($_COOKIE["name"])){echo "VOUS DEVEZ VOUS CONNECTER POUR POUVOIR CREER UN GROUPE";}
                                ?>
                                </p>
                            <a href="#m2-c" class="link-2"></a>
                        </div>
                    </div>
                </div>
                <script type="text/javascript" src="buttonpush.js"></script>
                <div class="box2">
                    <a href="#m2-o2" class="btna">View Group Members</a>
                    <div class="modal-container" id="m2-o2" style="--m-background: hsla(0, 0%, 0%, .4);">
                        <div class="modal">
                            <h1 class="modal__title2">LIST GROUP</h1>
                            </br></br></br>
                            <div class="listName">
                                <?php
                                require('listUser.php');
                                listUser();
                                ?>
                            </div>
                            <a href="#m2-c" class="link-2"></a>
                        </div>
                    </div>
                </div>
                <a class="btna" href="/PHPProject/AboutUS.php" style="margin-bottom: 20%;">About US</a>
                <div class="backpage">
                    <div class="box">
                        <a href="#m2-o4" class="link-12" id="m2-c4">CREATE GROUP</a>
                        <div class="modal-container" id="m2-o4" style="--m-background: hsla(0, 0%, 0%, .4);">
                            <div class="modal">
                            <h1 class="modal__title">ARE YOU SURE, DO YOU WANT TO CREATE A GROUP ?</h1>
                            <p class="modal__text">If you create a group you will quit the group that you are in. </p><p class="modal__text">Please enter a group name and click on cre ate group</p>
                            </br></br>
                            <p class="redInfo2">
                            <?php
                                if (!isset($_COOKIE["name"])){
                                    echo "VOUS DEVEZ VOUS CONNECTER POUR POUVOIR CREER UN GROUPE";
                                }else {
                                    echo '<form method="post" action="createGroups.php" id="stripe-login"><input class ="input" type="text" name="NameGroup" value="NameGroup"><input type="submit" class="modal__btn2" name="submit" value="YEAH IM SURE &rarr;"></form>';
                                }   
                            ?>
                            </p>
                            <a href="#m2-c4" class="link-2"></a>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <a href="#m2-o5" class="link-1" id="m2-c5">QUIT GROUP</a>
                        <div class="modal-container" id="m2-o5" style="--m-background: hsla(0, 0%, 0%, .4);">
                            <div class="modal">
                            <h1 class="modal__title">ARE YOU SURE TO QUIT GROUP ?</h1>
                            <p class="modal__text">if you quit the group you will loose all your point, if youre the captain the group will be dissolved !! SO ARE YOU SUR ??</p>
                            </br>
                            <form method="post" action="quitGroup.php" id="stripe-login">
                            <p class="redInfo2">
                            <?php
                                if (!isset($_COOKIE["name"])){
                                    echo "VOUS DEVEZ VOUS CONNECTEZ POUR POUVOIR QUITTER UN GROUPE";
                                }else {
                                    echo '<input type="submit" class="modal__btn" name="submit" value="YEAH IM SURE &rarr;">                                    ';
                                }
                            ?>
                            </p>
                            <a href="#m2-c5" class="link-2"></a>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>