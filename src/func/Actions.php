<?php
require_once('DBConnect.php');

Class Actions extends DB{
    function __construct(){
        parent::__construct();
    }

    function testValueUserMail(string $value) : string 
    {
        $sqlQuery = 'SELECT Name FROM user WHERE Mail = :valueName';
        $result = $this->SQLREQUEST($sqlQuery,$value,"fetch");
        return $result["Name"] ?? "";
    }

    function testValueUserName(string $value) : string 
    {
        $sqlQuery = 'SELECT * FROM user WHERE Name = :valueName';
        $result =$this->SQLREQUEST($sqlQuery,$value,"fetch");
        return $result["Name"] ?? "";
    }

    function testValuePassword(string $value, string $Nickname) : bool {
        $sqlQuery = 'SELECT Password FROM user WHERE Name = :Nickname';
        $result = $this->SQLREQUEST($sqlQuery,$Nickname,"fetch");
        return password_verify( $value,$result['Password']);
    }

    function acceptInvitation(){
        $sqlQuery = 'SELECT idGroup FROM user WHERE Name = :nameUser';
        $GrouporNot = $this->SQLREQUEST($sqlQuery,htmlspecialchars($_COOKIE["name"]),"fetch");
    
        if ($GrouporNot["idGroup"] == "" || $GrouporNot["idGroup"] == NULL) {
            $sqlQuery = 'SELECT id FROM groups WHERE chief = :userchief';
            $idgroup =$this->SQLREQUEST($sqlQuery,$_POST["nameInvit"],"fetch");
    
            $sqlQuery = 'UPDATE user SET idGroup = :idgroup WHERE Name = :username';
            $this->SQLREQUEST($sqlQuery,$idgroup["id"],htmlspecialchars($_COOKIE["name"]));
            $sqlQuery = 'UPDATE user SET invitationGroups = "" WHERE Name = :username';
            $this->SQLREQUEST($sqlQuery,htmlspecialchars($_COOKIE["name"]));
        }
        header("Location: /PHPProject/src/component/menu.php");
        exit();
    }

    function addHabit(){
        $name = $_POST["Name"];
        $Periodicity = $_POST["Periodicity"];
        $Description = $_POST["Description"];
        $Difficulty = $_POST["Difficulty"];
        $colorHabit = $_POST["colorHabit"];
        if ($name!= null && $name!= ""  && $Periodicity!= null && $Periodicity!= "" && $Description!= null && $Description!= "" && $Difficulty!= null && $Difficulty!= ""){
            $sqlQuery = 'SELECT * FROM user WHERE Name = :nameUser';
            $user =$this->SQLREQUEST($sqlQuery,$_COOKIE['name'],"fetch");
            $group = $user["idGroup"];
    
            if (strtotime($user['lastTimeAddHabit'])+24*3600<time()){
                $sqlQuery = 'UPDATE user SET lastTimeAddHabit = :lastTime WHERE Name = :nameUser';
                $this->SQLREQUEST($sqlQuery,date('Y-m-d H:i:s',time()),$_COOKIE["name"]);
                $sql = "INSERT INTO activity(groups, name,text,periodicity,lastTimeDo,difficulty,Color) VALUE (:groups,:name,:text,:periodicity,FROM_UNIXTIME(:lastTimeDo),:difficulty,:color)";
                $insertGroups = $this->db->prepare($sql);
                // Exécution ! Le groupe est maintenant en base de données
                $insertGroups->execute([
                    'groups' => $group,
                    'name' => $name,
                    'text' => $Description,
                    'periodicity' => $Periodicity,
                    'lastTimeDo' => strtotime('tomorrow')-3600,
                    'difficulty' => $Difficulty,
                    'color' => $colorHabit,
                ]);  
                  
            }else{
                ?> <script>alert("Vous ne pouvez pas ajouter une habitude car vous en avez deja ajouter une il y a - de 24h")</script> <?php
                header("Location: /PHPProject/src/component/menu.php");
                exit();
            }
        }
        
        header("Location: /PHPProject/src/component/menu.php");
        exit();

    }

    function addUser(){
        $nameInv = $_POST["userInv"];    
        $sqlQuery = 'SELECT chief FROM groups WHERE chief = :name';
        $result = $this->SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");
        if ($result["chief"] != "") {   
            $sqlQuery = 'SELECT Name,invitationGroups,idGroup FROM user WHERE Name = :name OR Mail= :mail';
            $groupsStatement = $this->db->prepare($sqlQuery);
            $groupsStatement->execute([
                'name'=>$nameInv,
                'mail' =>$nameInv,
            ],);
            $userInv = $groupsStatement->fetch();
            $sqlQuery = 'SELECT idGroup FROM user WHERE Name = :name';
            $user = $this->SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");
            $s = $userInv['invitationGroups']." ".strval($user['idGroup']);
            if (count(explode($user['idGroup'], $s)) == 2 && $userInv["idGroup"] != $user["idGroup"]) {
                $sqlQuery = 'UPDATE user SET invitationGroups = :invitationGroups WHERE Name = :nameUser';
                $this->SQLREQUEST($sqlQuery,$s,$userInv["Name"]);
            }
        }else {
            ?>
            <script> alert("you need to be the chief of a groupe for invite someone")</script>
            <?php
        }
        header("Location: /PHPProject/src/component/menu.php");
        exit();
    }

    function checkHabit($name){
        try{$db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);}
        catch (Exception $e){die('Erreur : ' . $e->getMessage());}
        $sqlQuery = 'SELECT * FROM user WHERE Name = :nameUser';
       
        $user = $this->SQLREQUEST($sqlQuery,$name,"fetch");
    
        $sqlQuery = 'SELECT * FROM user WHERE idGroup = 32';
        $groupsStatement = $db->prepare($sqlQuery);
        $groupsStatement->execute();
        $users = $groupsStatement->fetchAll();
        $nbUser = count($users);
    
        $sqlQuery = 'SELECT * FROM activity WHERE groups = :idGroup';
        $habits = $this->SQLREQUEST($sqlQuery,$user['idGroup'],"fetchAll");
    
        $sqlQuery = 'SELECT * FROM groups WHERE id = :idGroup';
        $group = $this->SQLREQUEST($sqlQuery,$user['idGroup'],"fetch");
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
                $this->SQLREQUEST($sqlQuery,$time,null,$habit['checkList'], $habit['id']);
    
                
            }
        }
        if($user["idGroup"] != "") {
            header("Location: /PHPProject/src/component/recap.php");
        }else {
            header("Location: /PHPProject/src/component/Menu.php");
        }
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

    function createGroups(){
        $sqlQuery = 'SELECT Name FROM user WHERE idGroup != "" AND Name = :cookieconnect';
        $result = $this->SQLREQUEST($sqlQuery,htmlspecialchars($_COOKIE["name"]),"fetchAll");
        echo "aofua";
        if (count($result) == 0) {
            $sqlQuery = 'INSERT INTO groups(score,chief,name) VALUES (:score,:name,:groupname)';
            // Préparation
            $insertGroups = $this->db->prepare($sqlQuery);
            // Exécution ! Le groupe est maintenant en base de données
            $insertGroups->execute([
                'score' => 1000,
                'name' => htmlspecialchars($_COOKIE["name"]),
                'groupname' => $_POST["NameGroup"],
            ]);

            $sqlQuery = 'SELECT id FROM groups WHERE chief = :cookiename';            
            $id = $this->SQLREQUEST($sqlQuery,htmlspecialchars($_COOKIE["name"]),"fetch");

            $sqlQuery = 'UPDATE user SET idGroup = :id WHERE name = :cookiename';
            $this->SQLREQUEST($sqlQuery,$id["id"],htmlspecialchars($_COOKIE["name"]));
        }
        ?><meta http-equiv="Refresh" content="0; url=../component/Menu.php" /><?php

    }

    function deco(){
        setcookie('name', null, -1,"/","localhost");
        header("Location: /PHPProject/src/component/Menu.php");
        exit();
    }

    function deniedInvitation(){
        $sqlQuery = 'SELECT id FROM groups WHERE chief = :userchief';
        $idgroup = $this->SQLREQUEST($sqlQuery,$_POST["nameInvit"],"fetch");

        $sqlQuery = 'SELECT invitationGroups FROM user WHERE Name = :username';
        $result = $this->SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");

        $listinvit = $result["invitationGroups"];
        $listinvit = explode(" ",$listinvit);
        echo $listinvit[0].$listinvit[1].$idgroup["id"];
        for ($i=0; $i < count($listinvit); $i++) { 
            if ($listinvit[$i] == $idgroup["id"]) {
                $listinvit[$i] = "";
            }
        }
        $sqlQuery = 'UPDATE user SET invitationGroups = :listinvit WHERE Name = :username';
        $this->SQLREQUEST($sqlQuery,join(" ",$listinvit),htmlspecialchars($_COOKIE["name"]));
        header("Location: /PHPProject/src/component/menu.php");
        exit();
    }

    function listUser(){
        if (isset($_COOKIE["name"])) {
            
            $sqlQuery = 'SELECT idGroup FROM user WHERE Name = :nameuser';
            $id = $this->SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");
            if ($id["idGroup"] != "") {
                $sqlQuery = 'SELECT Name FROM user WHERE idGroup=:id';
                $groups = $this->SQLREQUEST($sqlQuery,$id["idGroup"]);
                // On affiche chaque groupe un à un
                foreach ($groups as $name) {
                ?>
                    <h2><?php echo $name["Name"]; ?></h2>
                <?php
                }
            }
        }else {
            ?>
            <h2>You need to be connected for see members Group</h2>
            <?php
        }
    }

    function quitGroup(){
        $sqlQuery = 'SELECT idGroup FROM user WHERE Name = :nameUser';
        $result = $this->SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");
    if ($result["idGroup"] == "") {
        ?>
        <script>alert("You are not in a group")</script>
        <?php
        header("Location: /PHPProject/src/component/menu.php");
        exit();
    }else {
        // Ecriture de la requête
        $sqlQuery = 'UPDATE user SET idGroup = "" WHERE Name = :nameUser';
        $this->SQLREQUEST($sqlQuery,$_COOKIE["name"]);
        $sqlQuery = 'SELECT id FROM groups WHERE chief = :nameUser';
        $groupchief = $this->SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");
        $idgroupdelete = $groupchief["id"];
        $sqlQuery = 'DELETE FROM groups WHERE groups.id = :idgroup';
        $deletegroup = $this->db->prepare($sqlQuery);
        $deletegroup->execute([
            'idgroup' => $idgroupdelete,
        ]);

        $sqlQuery = 'DELETE FROM activity WHERE groups = :idgroup';
        $Groupdelete = $this->db->prepare($sqlQuery);
        $Groupdelete-> execute([
            'idgroup' => $idgroupdelete,
        ]);

        $sqlQuery = 'UPDATE user SET idGroup = "" WHERE idGroup = :idgroup';
        $this->SQLREQUEST($sqlQuery,$idgroupdelete);
        
        $sqlQuery = 'UPDATE user SET invitationGroups = TRIM(:idgroup FROM invitationGroups)';
        $this->SQLREQUEST($sqlQuery,$idgroupdelete);

        $sqlQuery = 'UPDATE activity SET checklist = TRIM(:username FROM checklist)';
        $this->SQLREQUEST($sqlQuery,$_COOKIE['name']);
        
        ?>
        <script>alert("You have quit your group")</script>
        <meta http-equiv="Refresh" content="0; url=../component/Menu.php" />
        <?php
    }

    }
}
$post = isset($_GET['post']) ?$_GET['post'] : '';
$action = new Actions();
switch($post){
    case 'acceptInvitation':
        echo $action->acceptInvitation();
    break;
    case 'addHabit':
        echo $action->addHabit();
    break;
    case 'addUser':
        echo $action->addUser();
    break;
    case 'deco':
        echo $action->deco();
    break;
    case 'createGroups':
        echo $action->createGroups();
    break;
    case 'deniedInvitation':
        echo $action->deniedInvitation();
    break;
    case 'listUser':
        echo $action->listUser();
    break;
    case 'quitGroup':
        echo $action->quitGroup();
    break;
    default:
    // default action here
    break;
}
?>