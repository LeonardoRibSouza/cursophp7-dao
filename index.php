<?php

require_once "config.php";

//$sql = new sql();

//$usuarios = $sql->select("SELECT *FROM usuarios");

//echo json_encode($usuarios);
//carrega um id
//$usuario = new Usuario();
//$usuario->carregarid(4);
//echo $usuario;

//carrega uma lista
//$list = usuario::getlist();
//ECHO json_encode($list);

//pequisa um nome
//$pesquisa = Usuario::Search("eloah");
//echo json_encode($pesquisa);

//carrega usuarios usando login e senha
$login = new Usuario();
$login->login("eloah","123456789fd");
echo $login;
?>