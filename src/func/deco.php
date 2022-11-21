<?php 
    setcookie('name', null, -1,"/","localhost");
    header("Location: /PHPProject/src/component/Menu.php");
    exit();
?>