<?php

require_once "config.php";

$sql = new sql();

$usuarios = $sql->select("SELECT *FROM usuarios");

echo json_encode($usuarios);
?>