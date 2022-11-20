<?php
function listUser(){
    if (isset($_COOKIE["name"])) {
        
        $sqlQuery = 'SELECT idGroup FROM user WHERE Name = :nameuser';
        $id = SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch");
        if ($id["idGroup"] != "") {
            $sqlQuery = 'SELECT Name FROM user WHERE idGroup=:id';
            $groups = SQLREQUEST($sqlQuery,$id["idGroup"]);
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

?>