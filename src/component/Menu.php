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
                               
                                // Ecriture de la requête
                                $sqlQuery = 'SELECT invitationGroups FROM user WHERE Name = :nameUser';
                                $res = $db->SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");
                                
                                $listInvit = explode(" ",$res["invitationGroups"]);
                                for ($i = 0;$i<count($listInvit);$i++) {
                                    if ($listInvit[$i] != "") {
                                        $sqlQuery = 'SELECT * FROM groups WHERE id = :idgroup';
                                        $row = $db->SQLREQUEST($sqlQuery,$listInvit[$i],"fetch");
                                        echo "<div class='invit'></br></br>".$row["chief"] . " AS INVITE YOU TO JOIN ".$row["name"]."  ";
                                        echo '<form action="../func/Actions.php?post=acceptInvitation" method="POST"><input type="hidden" value='.$row["chief"].' name="nameInvit"><input class="input" type="submit" name="submit" value="Accept">
                                        </form>
                                        <form action="../func/Actions.php?post=deniedInvitation" method="POST"><input type="hidden" value='.$row["chief"].' name="nameInvit"><input class="input" type="submit" name="submit" value="Denied"></form></br></br></div>';
                                    }
                                }
                            ?>
                        </p>
                    </div> 
                    <?php
                    $sqlQuery = 'SELECT idGroup FROM user WHERE Name = :userCookie';
                    $IdGroupUser = $db->SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");                    

                    $sqlQuery = 'SELECT * FROM activity WHERE groups = :idGroup';
                    $habits = $db->SQLREQUEST($sqlQuery,$IdGroupUser["idGroup"],"fetchAll"); 

                    $sqlQuery = 'SELECT * FROM user WHERE idGroup = :idGroup';
                    $user = $db->SQLREQUEST($sqlQuery,$IdGroupUser["idGroup"],"fetchAll");                    
                    
                    if ($IdGroupUser["idGroup"] != "" ) {
                        ?>
                        <div class="cards">
                        <?php
                        foreach ($habits as $habit){
                            ?>
                            <div class="card"style="border: ridge;border-color: <?php echo $habit["Color"];?>;">
                                <h2 class="card-title"><?php echo $habit["name"];?></h2>
                                <img src="../../assets/logo.png" alt="">
                                <p style="text-align: center;"><?php echo "difficulty : ". $habit["difficulty"]; ?></p>
                                <p style="text-align: center;"><?php echo "il reste ".date("H:i",abs(time()-strtotime($habit['lastTimeDo'])));?></p>
                                <div class="card-desc">
                                    <p><?php
                                        echo $habit["text"];
                                    ?></p>
                                    <form class="" method="POST" action="Menu.php">
                                    <div class="check">
                                        <?php
                                        if(in_array($_COOKIE["name"],explode(" ",$habit['checkList']))){
                                            echo "<p>you already do it ! Wanna cancel it ?</p>";
                                        }else{
                                            echo "<p>you can do it !</p>";
                                        }  
                                        ?>
                                        <input class="input" style="font-size: 0.8em;" type="submit" name="" value="check"> 
                                        <input class="input" style="font-size: 0.8em;" type="hidden" name="check" value="true">
                                        <input class="input"style="font-size: 0.8em;" type="hidden" name="idHabit" value="<?php echo $habit['id'];?>">
                                    </div>
                                    </form>
                                    <p><?php 
                                    if($habit['checkList']!=""&& $habit['checkList']!=null &&$habit['checkList'] != " "){
                                        echo (count(explode(" ",$habit['checkList'])))."/".count($user)." ".$habit['checkList'];
                                    }else{
                                        echo "0/".count($user);
                                    }
                                    ?></p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                        <div class="containAddHabit">
                        <div class="login-box">
                            <h2>Habit</h2>
                            <form action="../func/Actions.php?post=addHabit" name="forme" method="POST">
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
                                    <option value="3DAY">3 DAY</option>
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
                            </br></br>
                            <label>ColorHabit</label>
                            <input class="input" type="color" name="colorHabit">
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