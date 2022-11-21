<?php 
    setcookie('name', null, -1,"/","localhost");
    header("Location: /PHPProject/src/component/menu.php");
    exit();
?>