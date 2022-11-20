<?php 


include "../asset/header.php";
require "../func/functionSql.php";
$sqlQuery="SELECT * FROM user WHERE Name = :user";
$user = SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");
$sqlQuery = "SELECT * FROM activity WHERE groups = :idGroup";
$habits = SQLREQUEST($sqlQuery,$user["idGroup"],"fetchAll");
$sqlQuery = "SELECT * FROM user WHERE idGroup = :idGroup";
$users = SQLREQUEST($sqlQuery,$user["idGroup"]);
?>
    <body>
        <?php
        foreach($habits as $habit){
            $habitName = $habit["name"];
            echo "Habit Name : $habitName";
            if(count(explode(" ",$habit["lastCheckList"])) != count($users)){
                foreach($users as $userGroup){
                    if(!in_array($userGroup["Name"],explode(" ",$habit["lastCheckList"]))){
                        $var = $userGroup["Name"];
                        echo "<p>$var n'a pas fait le check-in</p>";
                    }
                }
                echo "<p>A cause de cette ou ces personnes qui n'ont pas réaliser l'habitude en temps voulu, vous avez perdu [] score</p>";
            }
        }
        ?>
        <form action="Menu.php" method="POST">
            <input type="submit" value="COMPRIS !">

        </form>
    </body>
</html>