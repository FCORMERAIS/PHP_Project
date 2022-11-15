<?php
    function addUser($nameInv,$nameUser){
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
        $sqlQuery = 'SELECT * FROM user WHERE Name = :name';
        $groupsStatement = $db->prepare($sqlQuery);
        $groupsStatement->execute(['name'=>$nameInv],);
        $userInv = $groupsStatement->fetchAll();
        // ///////////////////////////////////////////////////////////////////////////////////////
        $sqlQuery = 'SELECT * FROM user WHERE Name = :name';
        $groupsStatement = $db->prepare($sqlQuery);
        $groupsStatement->execute(['name'=>$nameUser],);
        $user = $groupsStatement->fetchAll();
        // ///////////////////////////////////////////////////////////////////////////////////////
        if (isset($user)){
            foreach ($user as $users) {
                // echo $users['Name']; 
                $user = $users;
                break;
            }
            foreach ($userInv as $usersinv) {
                // echo $usersinv['Name']; 
                $userInv = $usersinv;
                break;
            }
            ?>
            <script>console.log("laaaa eg")</script>
            <?php
        }else{
            ?>
            <script>console.log("pas la")</script>
            <?php
        }
        // echo $user['idGroup'];
        $s = $userInv['invitationGroups']." ".strval($user['idGroup']);
        if (count(explode($user['idGroup'], $s)) == 2) {
            $sqlQuery = 'UPDATE user SET invitationGroups = :invitationGroups WHERE Name = :nameUser';
            $insertGroups = $db->prepare($sqlQuery);
            $insertGroups->execute([
                'invitationGroups'=>$s,
                'nameUser' => $userInv["Name"],
            ]);
        }
    }
?>