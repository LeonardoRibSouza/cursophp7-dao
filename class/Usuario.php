<?php

class Usuario{

    private $deslogin;
    private $dessenha;
    private $idusuario;
    private $dtcadastro;

    public function getDeslogin(){
        return $this->deslogin;
    }
    public function setDeslogin($value){
        $this->deslogin = $value;
    }

    public function getDessenha(){
        return $this->dessenha;
    }
    public function setDessenha($value){
        $this->dessenha = $value;
    }

    public function getIdusuario(){
        return $this->idusuario;
    }
    public function setIdusuario($value){
        $this->idusuario = $value;
    }

    public function getDtcadastro(){
        return $this->dtcadastro;
    }
    public function setDtcadastro($value){
        $this->dtcadastro = $value;
    }

    public function carregarid($id){
        $sql = new sql();

        $result = $sql->select("SELECT * FROM usuarios WHERE idusuario = :ID", array(
            ":ID" => $id
        ));
    if (isset($result[0])){
        $row = $result[0];

        $this->setDeslogin($row['deslogin']);
        $this->setDessenha($row['dessenha']);
        $this->setDtcadastro(new datetime($row['dtcadastro']));
        $this->setIdusuario($row['idusuario']);
    }
    }
    public static function getlist(){
        $sql = new sql();
        return $sql->select("SELECT * FROM usuarios ORDER BY deslogin");
    }
    public static function Search($login){
        $sql = new Sql();
        return $sql->select("SELECT * FROM usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
        ':SEARCH' => "%".$login."%"
        ));
        }
    public function login($login,$senha){
        $sql = new sql();

        $result = $sql->select("SELECT * FROM usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
            ":LOGIN" => $login,
            ":SENHA" => $senha
        ));
    if (count($result[0])){
        $row = $result[0];

        $this->setDeslogin($row['deslogin']);
        $this->setDessenha($row['dessenha']);
        $this->setDtcadastro(new datetime($row['dtcadastro']));
        $this->setIdusuario($row['idusuario']);
    }else{
        throw new Exception("login e/ou senha invalidos");
    }
    }
    public function __toString(){
        return json_encode(array(
             "id do cadastro:" => $this->getIdusuario(),
             "login:" => $this->getDeslogin(),
             "senha:" => $this->getDessenha(),
             "data do cadastro:" => $this->getDtcadastro()->format("d/m/y")
        ));
        
    }
}

?>