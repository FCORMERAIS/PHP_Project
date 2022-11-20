<?php // TODO VERIFIER SI L'UTILISATEUR EST BIEN DANS UN GROUPE
    $nameInv = $_POST["userInv"];    
    $sqlQuery = 'SELECT chief FROM groups WHERE chief = :name';
    $result = SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");
    if ($result["chief"] != "") {   
        $sqlQuery = 'SELECT Name,invitationGroups,idGroup FROM user WHERE Name = :name OR Mail= :mail';
        $groupsStatement = $db->prepare($sqlQuery);
        $groupsStatement->execute([
            'name'=>$nameInv,
            'mail' =>$nameInv,
        ],);
        $userInv = $groupsStatement->fetch();
        // ///////////////////////////////////////////////////////////////////////////////////////
        $sqlQuery = 'SELECT idGroup FROM user WHERE Name = :name';
        $user = SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");
        $s = $userInv['invitationGroups']." ".strval($user['idGroup']);
        if (count(explode($user['idGroup'], $s)) == 2 && $userInv["idGroup"] != $user["idGroup"]) {
            $sqlQuery = 'UPDATE user SET invitationGroups = :invitationGroups WHERE Name = :nameUser';
            SQLREQUEST($sqlQuery,$s,$userInv["Name"]);
        }
    }else {
        ?>
        <script> alert("you need to be the chief of a groupe for invite someone")</script>
        <?php
    }
    header("Location: /PHPProject/src/component/menu.php");
    exit();
?>