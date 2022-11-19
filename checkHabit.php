<?php
function checkHabit($name){
    try{$db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);}
    catch (Exception $e){die('Erreur : ' . $e->getMessage());}
    $sqlQuery = 'SELECT * FROM user WHERE Name = :nameUser';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute([
        'nameUser' => $name,
    ]);
    $user = $groupsStatement->fetch();

    $sqlQuery = 'SELECT * FROM user WHERE idGroup = 32';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute();
    $users = $groupsStatement->fetchAll();
    $nbUser = count($users);

    $sqlQuery = 'SELECT * FROM activity WHERE groups = :idGroup';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute([
        'idGroup' => $user['idGroup'],
    ]);
    $habits = $groupsStatement->fetchAll();

	$sqlQuery = 'SELECT * FROM groups WHERE id = :idGroup';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute([
        'idGroup' => $user['idGroup'],
    ]);
    $group = $groupsStatement->fetch();
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
                    break;
            }
            $sqlQuery = 'UPDATE activity SET lastTimeDo = :time, checkList = :checkList WHERE id = :idHabit';
            $groupsStatement = $db->prepare($sqlQuery);
            $groupsStatement->execute([
                'time' => $time,
                'checkList' => null,
                'idHabit' => $habit['id'],

            ]);
            //TODO Retenir les modif et les afficher
            

            header("Location: /PHPProject/Menu.php");
            exit();
        }
    }
	if ($group['score']<0){
		$sqlQuery = 'UPDATE user SET idGroup = "" WHERE Name = :nameUser';
		$insertGroups = $db->prepare($sqlQuery);
		$insertGroups->execute([
			'nameUser' => htmlspecialchars($name),
		]);
		$sqlQuery = 'UPDATE user SET idGroup = "" WHERE idGroup = :idgroup';
		$Groupdelete = $db->prepare($sqlQuery);
		$Groupdelete-> execute([
			'idgroup' => $group['id'],
		]);
		$sqlQuery = 'DELETE FROM groups WHERE groups.id = :idgroup';
		$deletegroup = $db->prepare($sqlQuery);
		$deletegroup->execute([
			'idgroup' => $group['id'],
		]);
	}else{
		
	}
}

?>