<?php session_start()?>
<?php
  if(!isset($_COOKIE["name"]))
    {$connexion ="You are not connected";
  }else { 
    $connexion = 'Connected As ' . htmlspecialchars($_COOKIE["name"]) . ' !';
  }
  if (isset($_POST['check'])&& !empty($_POST['check']) && $_POST['check']=="true"){
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery = 'SELECT * FROM activity WHERE id = :idHabit';
    $groupsStatement = $db->prepare($sqlQuery);
    $groupsStatement->execute(
        [
            'idHabit'=>$_POST["idHabit"],
        ]);
    $habit = $groupsStatement->fetch();
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
    $insertGroups = $db->prepare($sqlQuery);
    $insertGroups->execute([
        'checkList'=>$checkList,
        'idHabit' => $_POST['idHabit'],
    ]);
  }