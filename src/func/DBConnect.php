<?php
class DB {
    public $db;
    function __construct(){
        //initialize $db with the connexion with the db
        $this->db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        if(!$this->db){
            die("Database Connection Failed. Error: ".$this->db);
        }
    }
    
    /**
     * usefull to call SQL in 1 line with the function
     *
     * @param  mixed $sqlQuery
     * @param  mixed $var1
     * @param  mixed $var2
     * @param  mixed $var3
     * @param  mixed $var4
     */
    function SQLREQUEST(string $sqlQuery, $var1,$var2=null,$var3=null,$var4=null) {        
        if (explode(" ",$sqlQuery)[0] == "SELECT") { 
            $groupsStatement = $this->db->prepare($sqlQuery);
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
                $a = $a+strpos(substr($sqlQuery,$a),":")+1;
            }
            if ($var2 ==null && $var3==null){
                $sql = $this->db->prepare($sqlQuery);
                $sql->execute([
                    $arr[0] => $var1,
                ]);
            }else if ($var3==null){
                $sql = $this->db->prepare($sqlQuery);
                $sql->execute([
                    $arr[0] => $var1,
                    $arr[1] => $var2,
                ]);
            }else{
                $sql = $this->db->prepare($sqlQuery);
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

}
?>