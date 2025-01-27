<?php

class Sql extends PDO{

    private $conn;

    public function __construct(){
        $this->conn = new PDO("mysql:dbname=test;host=localhost","root","");
    }
 
    private function setParams($stament,$parameters = array()){
        foreach ($parameters as $key => $value){
            $this->setparam($stament,$key,$value);
         }
    }

    private function setParam($stament,$key,$value){
        $stament->bindparam($key,$value);
    }

    public function rquery($rawquery,$params = array()){
        $st = $this->conn->prepare($rawquery);
        $this->setParams($st,$params);
        $st->execute();
        return $st;
    }

    public function select($rawquery,$params = array()):array{
        $st = $this->rquery($rawquery,$params);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>