<?php


include "../asset/header.php";
include "../func/DBConnect.php";
$db = new DB();
//all request SQL
$sqlQuery="SELECT * FROM user WHERE Name = :user";
$user = $db->SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");
$sqlQuery = "SELECT * FROM activity WHERE groups = :idGroup";
$habits = $db->SQLREQUEST($sqlQuery,$user["idGroup"],"fetchAll");
$sqlQuery = "SELECT * FROM user WHERE idGroup = :idGroup";
$users = $db->SQLREQUEST($sqlQuery,$user["idGroup"]);
?>
    <body class = "bodyRecap">
        <?php
        // display all habit if they have be do by everyone
        if(date("d",strtotime($user["lastConnexion"]))!=date("d")){
            foreach($habits as $habit){
                switch ($habit["periodicity"]){
                    case "1DAY":
                        $time = date('Y-m-d H:i:s',strtotime($habit["lastTimeDo"])-24*3600);
                        break;
                    case "3DAY":
                        $time = date('Y-m-d H:i:s',strtotime($habit["lastTimeDo"])-24*3600*3);
                        break;
                    case "1WEEK":
                        $time = date('Y-m-d H:i:s',strtotime($habit["lastTimeDo"])-24*3600*7);
                        break;
                    case "2WEEK":
                        $time = date('Y-m-d H:i:s',strtotime($habit["lastTimeDo"])-24*3600*14);
                        break;
                    case "1MONTH":
                        $time = date('Y-m-d H:i:s',strtotime($habit["lastTimeDo"])-24*3600*31);
                        break;
                    default:
                    echo $time."";
    
                        break;
                }
                if(strtotime($time)<time()){
                    $habitName = $habit["name"];
                    echo "<h2 style='margin-top: 100px;'> Habit Name : $habitName </h2></br></br></br>";
                    if(count(explode(" ",$habit["lastCheckList"])) != count($users)){
                        foreach($users as $userGroup){
                            switch ($habit["difficulty"]){
                                case "S":
                                    $score= 100;
                                    break;
                                case "A":
                                    $score= 60;
                                    break;
                                case "B":
                                    $score= 50;
                                    break;
                                case "C":
                                    $score= 30;
                                    break;
                                case "D":
                                    $score= 10;
                                    break;
                                default:
                                    break;
                            } 
                            if(!in_array($userGroup["Name"],explode(" ",$habit["lastCheckList"]))){
                                $var = $userGroup["Name"];
                                ?><p class="recap"> <?php echo "$var n'a pas fait le check-in, Vous avez perdu $score points !";?> </p>; <?php
                            }else{
                                $var = $userGroup["Name"];
                                ?><p class="recap"> <?php echo "$var a bien fait le check-in, Vous avez Gagner $score points !";?> </p>; <?php
                            }
                        }
                    }
                }
                ?></div><?php
            }
            $sqlQuery = "UPDATE user SET lastConnexion = :timeNow WHERE Name = :name";
            $db->SQLREQUEST($sqlQuery,date('Y-m-d H:i:s',strtotime("now")+3600),$_COOKIE["name"]);
            $sqlQuery = "SELECT * FROM groups WHERE id = :idGroup";
            $group = $db->SQLREQUEST($sqlQuery,$user["idGroup"],"fetch");
            if ((int)$group["score"]  < 0) {
                $sqlQuery = 'UPDATE user SET idGroup = "" WHERE Name = :userName';
                $group = $db->SQLREQUEST($sqlQuery,$user["Name"]);
                $sqlQuery = 'UPDATE user SET invitationGroups = TRIM(:idgroup FROM invitationGroups)';
                $deleteInvitation = $db->SQLREQUEST($sqlQuery,$user["idGroup"]);
                echo "YOU HAVE BEEN KICKING FROM YOUR GROUP BECAUSE YOUR SCORE WAS UNDER 0 </br></br></br>";
                $sqlQuery = 'SELECT * FROM user WHERE idGroup = :idGroup';
                $verifyNbInGroup = $db->SQLREQUEST($sqlQuery,$user["idGroup"],"fetchAll");
                if (count($verifyNbInGroup) == 0) {
                    $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
                    if(!$db){
                        die("Database Connection Failed. Error: ".$db);
                    }
                    $sqlQuery = 'DELETE FROM groups WHERE id = :idGroup';
                    $verifyNbInGroup = $db->prepare($sqlQuery);
                    $verifyNbInGroup -> execute(["idGroup" => $user["idGroup"],]);
                    $sqlQuery = 'DELETE FROM activity WHERE groups = :idGroup';
                    $verifyNbInGroup = $db->prepare($sqlQuery);
                    $verifyNbInGroup -> execute(["idGroup" => $user["idGroup"],]);
                }
            }else {
                echo "</br></br>YOUR GROUP HAVE ". $group["score"] ." OF SCORING </br></br></br>";
            }
            }else{
                header("Location: /PHPProject/src/component/menu.php");
                exit();
            }
        ?>
        <form action="Menu.php" method="POST">
            <input class ="input"type="submit" class="buttonRecap" value="COMPRIS !">
        </form>
    </body>
</html>