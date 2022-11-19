<?php // TODO VERIFIER SI L'UTILISATEUR EST BIEN DANS UN GROUPE
    function addUser($nameInv){
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
        $sqlQuery = 'SELECT chief FROM groups WHERE chief = :name';
        $groupsStatement = $db->prepare($sqlQuery);
        $groupsStatement->execute(['name'=>$_COOKIE["name"]],);
        $result = $groupsStatement->fetch();
        if ($result["chief"] != "") {   
            $sqlQuery = 'SELECT Name,invitationGroups,idGroup FROM user WHERE Name = :name';
            $groupsStatement = $db->prepare($sqlQuery);
            $groupsStatement->execute(['name'=>$nameInv],);
            $userInv = $groupsStatement->fetch();
            // ///////////////////////////////////////////////////////////////////////////////////////
            $sqlQuery = 'SELECT idGroup FROM user WHERE Name = :name';
            $groupsStatement = $db->prepare($sqlQuery);
            $groupsStatement->execute(['name'=>$_COOKIE["name"]],);
            $user = $groupsStatement->fetch();
            $s = $userInv['invitationGroups']." ".strval($user['idGroup']);
            if (count(explode($user['idGroup'], $s)) == 2 && $userInv["idGroup"] != $user["idGroup"]) {
                $sqlQuery = 'UPDATE user SET invitationGroups = :invitationGroups WHERE Name = :nameUser';
                $insertGroups = $db->prepare($sqlQuery);
                $insertGroups->execute([
                    'invitationGroups'=>$s,
                    'nameUser' => $userInv["Name"],
                ]);
            }
        }
    }
?>