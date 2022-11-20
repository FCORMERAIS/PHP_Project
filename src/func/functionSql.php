<?php
function SQLREQUEST(string $sqlQuery, $var1,$var2=null,$var3=null,$var4=null) {
    try{$db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);}
    catch (Exception $e){die('Erreur : ' . $e->getMessage());}
    
    if (explode(" ",$sqlQuery)[0] == "SELECT") { 
        $groupsStatement = $db->prepare($sqlQuery);
        $groupsStatement->execute([
            explode(" ",stristr($sqlQuery,":"))[0]=>$var1,
        ]);
        if($var2 == "fetch"){
            return $IdGroupUser=$groupsStatement->fetch();
        }else{
            return $IdGroupUser=$groupsStatement->fetchAll();
        }
    }else if (explode(" ",$sqlQuery)[0] == "UPDATE"){
        $arr = [];
        $a=0;
        for($i=0;$i<4;$i++){
            array_push($arr,$sub = explode(" ",stristr(substr($sqlQuery,$a),":"))[0]);
            $a = strpos(substr($sqlQuery,$a),":")+1;
            // $i = $a+1;
        }
        if ($var2 ==null){
            $sql = $db->prepare($sqlQuery);
            $sql->execute([
                $arr[0] => $var1,
            ]);
        }else if ($var3==null){
            $sql = $db->prepare($sqlQuery);
            $sql->execute([
                $arr[0] => $var1,
                $arr[1] => $var2,
            ]);
        }else{
            $sql = $db->prepare($sqlQuery);
            $sql->execute([
                $arr[0] => $var1,
                $arr[1] => $var2,
                $arr[2] => $var3,
                $arr[3] => $var4,
            ]);
        }
    }
    return null;

}
?>
