<?php
    include "../asset/phpMenu.php";
    include "../asset/header.php";
    ?>  

    <body class="corps">
        <?php
        include "../asset/navbar.php";
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
                                        echo '<form action="../func/AcceptInvitation.php" method="POST"><input type="hidden" value='.$row["chief"].' name="nameInvit"><input class="input" type="submit" name="submit" value="Accept">
                                        </form>
                                        <form action="../func/deniedInvitation.php" method="POST"><input type="hidden" value='.$row["chief"].' name="nameInvit"><input class="input" type="submit" name="submit" value="Denied"></form></br></br></div>';
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
                            <div class="cardHabit"style="background-color: <?php 
                            if ($habit["difficulty"] == "S") {
                                echo "#D2DB96";
                            }else if ($habit["difficulty"] == "A") {
                                echo "#6AA6F3";
                            }else if ($habit["difficulty"] == "B") {
                                echo "#23BD9D";
                            }else if ($habit["difficulty"] == "C") {
                                echo "#99F580";
                            }else {
                                echo "#78034E";
                            }
                            ;?>;">
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
                                        <input class="input"type="submit" name="" value="check"> 
                                        <input class="input" type="hidden" name="check" value="true">
                                        <input class="input"type="hidden" name="idHabit" value="<?php echo $habit['id'];?>">
                                </div>
                                </form>
                                <div class="nbDo">
                                    <p><?php 
                                    if($habit['checkList']!=""&& $habit['checkList']!=null &&$habit['checkList'] != " "){
                                        echo (count(explode(" ",$habit['checkList']))-1)."/".count($user)." ".$habit['checkList'];
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
                            <form action="../func/addHabit.php" name="forme" method="POST">
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
                                <select class="input" name="Periodicity" id="periodicity" >
                                    <option value="">--Please choose an option--</option>
                                    <option value="1DAY">1 DAY</option>
                                    <option value="2DAY">3 DAY</option>
                                    <option value="1WEEK">1 WEEK</option>
                                    <option value="2WEEK">2 WEEK</option>
                                    <option value="1MONTH">1 MONTH</option>
                                </select>   
                            </div>
                            <label>Difficulty</label>
                            <select class="input" name="Difficulty" id="difficulty" >
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
        <?php
            include "../asset/overlay.php"
        ?>
    </body>
</html>