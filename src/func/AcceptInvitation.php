<?php 
   require "../func/functionSql.php";
    $sqlQuery = 'SELECT idGroup FROM user WHERE Name = :nameUser';
    $GrouporNot = SQLREQUEST($sqlQuery,htmlspecialchars($_COOKIE["name"]),"fetch");

    if ($GrouporNot["idGroup"] == "" || $GrouporNot["idGroup"] == NULL) {
        $sqlQuery = 'SELECT id FROM groups WHERE chief = :userchief';
        $idgroup =SQLREQUEST($sqlQuery,$_POST["nameInvit"],"fetch");

        $sqlQuery = 'UPDATE user SET idGroup = :idgroup WHERE Name = :username';
        SQLREQUEST($sqlQuery,$idgroup["id"],htmlspecialchars($_COOKIE["name"]));
        $sqlQuery = 'UPDATE user SET invitationGroups = "" WHERE Name = :username';
        SQLREQUEST($sqlQuery,htmlspecialchars($_COOKIE["name"]));
    }
    header("Location: /PHPProject/src/component/menu.php");
    exit();
?>