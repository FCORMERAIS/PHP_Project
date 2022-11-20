<?php
function checkHabit($name){
    try{$db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);}
    catch (Exception $e){die('Erreur : ' . $e->getMessage());}
    $sqlQuery = 'SELECT * FROM user WHERE Name = :nameUser';
   
    $user = SQLREQUEST($sqlQuery,$name,"fetch");

    $sqlQuery = 'SELECT * FROM user WHERE idGroup = 32';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute();
    $users = $groupsStatement->fetchAll();
    $nbUser = count($users);

    $sqlQuery = 'SELECT * FROM activity WHERE groups = :idGroup';
    $habits = SQLREQUEST($sqlQuery,$user['idGroup'],"fetchAll");

	$sqlQuery = 'SELECT * FROM groups WHERE id = :idGroup';
    $group = SQLREQUEST($sqlQuery,$user['idGroup'],"fetch");
    foreach($habits as $habit){
        if(strtotime($habit['lastTimeDo'])<time()){
            if($nbUser==count(explode(" ",$habit['checkList']))){
                //TODO SCORE POSITIF
            }else{
                //TODO SCORE NEGATIF
            }
			
            $time="";
            switch ($habit["periodicity"]){
                case "1DAY":
                    $time = date('Y-m-d H:i:s',strtotime($habit["lastTimeDo"])+24*3600);
                    break;
                case "3DAY":
                    $time = date('Y-m-d H:i:s',strtotime($habit["lastTimeDo"])+24*3600*3);
                    break;
                case "1WEEK":
                    $time = date('Y-m-d H:i:s',strtotime($habit["lastTimeDo"])+24*3600*7);
                    break;
                case "2WEEK":
                    $time = date('Y-m-d H:i:s',strtotime($habit["lastTimeDo"])+24*3600*14);
                    break;
                case "1MONTH":
                    $time = date('Y-m-d H:i:s',strtotime($habit["lastTimeDo"])+24*3600*31);
                    break;
                default:
                echo $time."gaa";

                    break;
            }
            $sqlQuery = 'UPDATE activity SET lastTimeDo = :time , checkList = :checkList , lastCheckList = :lastCheckList WHERE id = :idHabit';
            SQLREQUEST($sqlQuery,$time,null,$habit['checkList'], $habit['id']);

            
        }
    }
    header("Location: /PHPProject/src/component/Menu.php");
    exit();
	// if ($group['score']<0){
	// 	$sqlQuery = 'UPDATE user SET idGroup = "" WHERE Name = :nameUser';
	// 	$insertGroups = $db->prepare($sqlQuery);
	// 	$insertGroups->execute([
	// 		'nameUser' => htmlspecialchars($name),
	// 	]);
	// 	$sqlQuery = 'UPDATE user SET idGroup = "" WHERE idGroup = :idgroup';
	// 	$Groupdelete = $db->prepare($sqlQuery);
	// 	$Groupdelete-> execute([
	// 		'idgroup' => $group['id'],
	// 	]);
	// 	$sqlQuery = 'DELETE FROM groups WHERE groups.id = :idgroup';
	// 	$deletegroup = $db->prepare($sqlQuery);
	// 	$deletegroup->execute([
	// 		'idgroup' => $group['id'],
	// 	]);
	// }else{
		
	// }
}

?>