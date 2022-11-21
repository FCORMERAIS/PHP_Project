<?php


include "../asset/header.php";
require "../func/DBConnect.php";
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
        foreach($habits as $habit){
            $habitName = $habit["name"];
            echo "<p style='margin-top: 100px;
            margin-left: 200px;'> Habit Name : $habitName </p>";
            if(count(explode(" ",$habit["lastCheckList"])) != count($users)){
                foreach($users as $userGroup){
                    if(!in_array($userGroup["Name"],explode(" ",$habit["lastCheckList"]))){
                        $var = $userGroup["Name"];
                        ?><p class="recap"> <?php echo "$var n'a pas fait le check-in";?> </p>; <?php
                    }
                }
                echo "<p class='recapfinal'>A cause de cette ou ces personnes qui n'ont pas réaliser l'habitude en temps voulu, vous avez perdu [] score</p>";
            }
        }
        ?>
        <form action="Menu.php" method="POST">
            <input type="submit" class="buttonRecap" value="COMPRIS !">

        </form>
    </body>
</html>