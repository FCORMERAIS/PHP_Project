<?php session_start()?>
<?php
  require("../func/functionSql.php");
  if(!isset($_COOKIE["name"]))
    {$connexion ="You are not connected";
  }else { 
    $connexion = 'Connected As ' . htmlspecialchars($_COOKIE["name"]) . ' !';
  }
  if (isset($_POST['check'])&& !empty($_POST['check']) && $_POST['check']=="true"){
    $sqlQuery = 'SELECT * FROM activity WHERE id = :idHabit';
    $habit = SQLREQUEST($sqlQuery,$_POST["idHabit"],"fetch");
    $checkList="";
    if ($habit['checkList'] != "" || $habit['checkList'] != null){
        if(in_array($_COOKIE["name"],explode(" ",$habit['checkList']))){
            if (count(explode(" ",$habit['checkList']))!=1){
                $a = explode(" ",$habit['checkList']);
                $key = array_search($_COOKIE["name"], $a);
                unset($a[$key]);
                $checkList=join(" ",$a);
            }else{
                $checkList = null;
            }
        }else{
            $checkList=$habit['checkList']." ".$_COOKIE["name"];
        }
    }else{
        $checkList=$_COOKIE["name"];
    }

    $sqlQuery = 'UPDATE activity SET checkList = :checkList WHERE id = :idHabit';
    SQLREQUEST($sqlQuery,$checkList,$_POST['idHabit']);
  }