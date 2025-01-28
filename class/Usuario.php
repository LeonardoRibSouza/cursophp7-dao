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

            $this->setData($result[0]);
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
        if (count($result) > 0) {

            $row = $result[0];

            $this->setData($result[0]);

        } else {
            throw new Exception("Login e/ou senha inválidos.");
        }
    }
    
    public function insert(){
        
        $sql = new Sql();
        
        $result = $sql->select("CALL sp_usuarios_insert(:LOGIN,:SENHA)",array(
            ':LOGIN'=>$this->getDeslogin(),
            ':SENHA'=>$this->getDessenha()
        ));
        
        if (count($result) < 0){
            $this->setdata($result[0]);
        }
    
    }

    public function __construct($login = "",$senha = ""){
        $this->setDeslogin($login);
        $this->setdessenha($senha);
    }
    
    public function Update($login,$senha,$id){
        $this->setDeslogin($login);
        $this->setDessenha($senha);
        $this->setIdusuario($id);
        
        $sql = new Sql();
        $sql->rquery("UPDATE usuarios SET deslogin = :LOGIN , dessenha = :SENHA WHERE idusuario = :ID",array(
            ':LOGIN'=>$this->getDeslogin(),
            ':SENHA'=>$this->getdesSenha(),
            ':ID'=>$this->getIdusuario()
        ));

    }
    
    public function __toString(){
        return json_encode(array(
             "id do cadastro:" => $this->getIdusuario(),
             "login:" => $this->getDeslogin(),
             "senha:" => $this->getDessenha(),
             "dtcadastro:" => $this->getDtcadastro()
        ));
        
    }
    
    public function setData($data){
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new datetime($data['dtcadastro']));
        $this->setIdusuario($data['idusuario']); 
    }
}

?>