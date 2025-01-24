<?php

class sql extends PDO{

    private $conn;

    public function __construct(){
        $this->conn = new PDO("mysql:dbname=test;host=localhost","root","");
    }
 
    private function setparams($stament,$parameters = array()){
        foreach ($parameters as $key => $value){
            $stament->setparam($key,$value);
         }
    }

    private function setparam($stament,$key,$value){
        $stament->bindparam($key,$value);
    }

    public function rquery($rawquery,$params = array()){
        $st = $this->conn->prepare($rawquery,$params);
        $this->setparams($st,$params);
        $st->execute();
        return $st;
    }

    public function select($rawquery,$params = array()){
        $st = $this->rquery($rawquery,$params);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>